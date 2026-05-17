<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import { useGameStore } from '../../stores/game'
import { usePlayerStore } from '../../stores/player'
import api from '../../api'
import { useI18n } from 'vue-i18n'

// PrimeVue
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'
import InputNumber from 'primevue/inputnumber'
import Dialog from 'primevue/dialog'
import Select from 'primevue/select'

const route = useRoute()
const gameStore = useGameStore()
const playerStore = usePlayerStore()
const { t } = useI18n()

const game = ref(null)
const loading = ref(true)
const isAddPlayerModalOpen = ref(false)
const selectedPlayer = ref(null)

const fetchGame = async () => {
  loading.value = true
  try {
    const response = await api.get(`/games/${route.params.id}`)
    game.value = response.data
  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchGame()
  playerStore.fetchAll()
})

const addPlayerToGame = async () => {
  if (!selectedPlayer.value) return
  try {
    const payload = {
      game: `/games/${game.value.id}`,
      player: `/players/${selectedPlayer.value}`,
      position: game.value.stakes.length + 1,
      runOne: 0,
      runTwo: 0,
      runThree: 0,
      runFour: 0,
      runFive: 0,
      runSix: 0,
      runSeven: 0,
      runEight: 0,
      total: 0
    }
    await api.post('/stakes', payload)
    isAddPlayerModalOpen.value = false
    selectedPlayer.value = null
    fetchGame() // Refresh
  } catch (err) {
    alert('Error al añadir jugador')
  }
}

const updateStake = async (stake) => {
  try {
    const total = (stake.runOne || 0) + (stake.runTwo || 0) + (stake.runThree || 0) + 
                  (stake.runFour || 0) + (stake.runFive || 0) + (stake.runSix || 0) + 
                  (stake.runSeven || 0) + (stake.runEight || 0)
    
    await api.patch(`/stakes/${stake.id}`, {
      runOne: stake.runOne,
      runTwo: stake.runTwo,
      runThree: stake.runThree,
      runFour: stake.runFour,
      runFive: stake.runFive,
      runSix: stake.runSix,
      runSeven: stake.runSeven,
      runEight: stake.runEight,
      total: total
    }, {
      headers: { 'Content-Type': 'application/merge-patch+json' }
    })
    stake.total = total // Update UI locally
  } catch (err) {
    console.error(err)
  }
}
</script>

<template>
  <div class="p-4">
    <div v-if="loading" class="flex justify-center p-8">
      <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
    </div>

    <div v-else-if="game">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
          <Button icon="pi pi-arrow-left" text @click="$router.back()" class="mr-2" />
          <h1 class="text-3xl font-bold inline-block m-0">{{ game.name }}</h1>
          <p class="text-muted">{{ formatDate(game.date) }} - {{ game.field?.name }}</p>
        </div>
        <Button label="Añadir Jugador" icon="pi pi-user-plus" @click="isAddPlayerModalOpen = true" />
      </div>

      <DataTable :value="game.stakes" stripedRows class="card p-datatable-sm">
        <Column field="position" header="Pos" style="width: 3rem"></Column>
        <Column header="Jugador">
          <template #body="slotProps">
            <div class="font-bold">{{ slotProps.data.player?.name }} {{ slotProps.data.player?.surname }}</div>
            <div class="text-xs opacity-60">{{ slotProps.data.player?.club?.name }}</div>
          </template>
        </Column>
        
        <Column header="T1">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runOne" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>
        <Column header="T2">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runTwo" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>
        <Column header="T3">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runThree" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>
        <Column header="T4">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runFour" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>
        <Column header="T5">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runFive" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>
        <Column header="T6">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runSix" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>
        <Column header="T7">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runSeven" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>
        <Column header="T8">
          <template #body="slotProps">
            <InputNumber v-model="slotProps.data.runEight" @blur="updateStake(slotProps.data)" :min="0" :max="9" inputStyle="width: 3rem; text-align: center" />
          </template>
        </Column>

        <Column header="Total" style="width: 5rem">
          <template #body="slotProps">
            <div class="text-xl font-black text-primary">{{ slotProps.data.total || 0 }}</div>
          </template>
        </Column>
      </DataTable>
    </div>

    <Dialog v-model:visible="isAddPlayerModalOpen" modal header="Añadir Jugador al Concurso" :style="{ width: '400px' }">
      <div class="p-4">
        <label class="block font-bold mb-2">Seleccionar Jugador</label>
        <Select v-model="selectedPlayer" :options="playerStore.items" optionLabel="name" optionValue="id" filter placeholder="Busca un jugador..." fluid>
          <template #option="slotProps">
            {{ slotProps.option.name }} {{ slotProps.option.surname }} ({{ slotProps.option.club?.name }})
          </template>
        </Select>
      </div>
      <template #footer>
        <Button label="Cancelar" icon="pi pi-times" text @click="isAddPlayerModalOpen = false" />
        <Button label="Añadir" icon="pi pi-check" @click="addPlayerToGame" />
      </template>
    </Dialog>
  </div>
</template>

<script>
const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  return new Date(dateString).toLocaleDateString()
}
</script>
