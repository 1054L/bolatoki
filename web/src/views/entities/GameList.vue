<script setup>
import { ref, onMounted } from 'vue'
import { useGameStore } from '../../stores/game'
import { useChampionshipStore } from '../../stores/championship'
import { useFieldStore } from '../../stores/field'
import { useFormatStore } from '../../stores/format'
import { useI18n } from 'vue-i18n'

// PrimeVue Components
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import Select from 'primevue/select'
import DatePicker from 'primevue/datepicker'

const store = useGameStore()
const championshipStore = useChampionshipStore()
const fieldStore = useFieldStore()
const formatStore = useFormatStore()
const { t } = useI18n()

const isModalOpen = ref(false)
const form = ref({
  name: '',
  date: new Date(),
  field: null,
  format: null,
  championships: []
})

onMounted(() => {
  store.fetchAll()
  championshipStore.fetchAll()
  fieldStore.fetchAll()
  formatStore.fetchAll()
})

const openModal = () => {
  form.value = { name: '', date: new Date(), field: null, format: null, championships: [] }
  isModalOpen.value = true
}

const handleSubmit = async () => {
  try {
    const payload = {
      name: form.value.name,
      date: form.value.date.toISOString(),
      field: `/fields/${form.value.field}`,
      format: `/formats/${form.value.format}`,
      championships: form.value.championships.map(id => `/championships/${id}`)
    }
    await store.create(payload)
    isModalOpen.value = false
  } catch (err) {
    alert('Error al crear el concurso')
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  return new Date(dateString).toLocaleDateString()
}
</script>

<template>
  <div class="p-4">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
      <h1 class="text-3xl font-bold m-0">{{ t('nav.games') }}</h1>
      <Button :label="'Nuevo Concurso'" icon="pi pi-plus" @click="openModal" severity="primary" />
    </div>

    <DataTable :value="store.items" :loading="store.loading" stripedRows class="p-datatable-sm card">
      <Column field="id" header="ID" style="width: 5rem">
        <template #body="slotProps">
          <span class="font-mono text-muted">#{{ slotProps.data.id }}</span>
        </template>
      </Column>
      
      <Column :header="'Concurso'">
        <template #body="slotProps">
          <RouterLink :to="{ name: 'game-detail', params: { id: slotProps.data.id } }" style="text-decoration: none; color: inherit;">
            <div class="font-bold text-lg hover:text-primary cursor-pointer">{{ slotProps.data.name }}</div>
            <div class="text-xs opacity-60">{{ formatDate(slotProps.data.date) }}</div>
          </RouterLink>
        </template>
      </Column>

      <Column header="Campeonato">
        <template #body="slotProps">
          <div v-if="slotProps.data.championships && slotProps.data.championships.length > 0">
            <span v-for="champ in slotProps.data.championships" :key="champ.id" class="badge mr-2">
              {{ champ.name }}
            </span>
          </div>
          <span v-else class="text-muted italic text-xs">Independiente</span>
        </template>
      </Column>

      <Column header="Bolatoki (Bolatoki)">
        <template #body="slotProps">
          {{ slotProps.data.field?.name || 'N/A' }}
        </template>
      </Column>

      <Column :header="t('common.actions')" style="text-align: right">
        <template #body>
          <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
            <Button icon="pi pi-pencil" severity="secondary" text rounded />
            <Button icon="pi pi-trash" severity="danger" text rounded />
          </div>
        </template>
      </Column>
    </DataTable>

    <Dialog v-model:visible="isModalOpen" modal :header="'Nuevo Concurso'" :style="{ width: '450px' }">
      <div style="display: flex; flex-direction: column; gap: 1.5rem; padding-top: 1rem;">
        <div class="form-group">
          <label class="font-bold">Nombre del Concurso</label>
          <InputText v-model="form.name" placeholder="Ej: Gran Premio Bolatoki" fluid />
        </div>

        <div class="form-group">
          <label class="font-bold">Fecha</label>
          <DatePicker v-model="form.date" dateFormat="dd/mm/yy" fluid />
        </div>

        <div class="form-group">
          <label class="font-bold">Bolatoki (Instalación)</label>
          <Select v-model="form.field" :options="fieldStore.items" optionLabel="name" optionValue="id" placeholder="Selecciona el bolatoki" fluid />
        </div>

        <div class="form-group">
          <label class="font-bold">Formato de Tiradas</label>
          <Select v-model="form.format" :options="formatStore.items" optionLabel="name" optionValue="id" placeholder="Selecciona el formato" fluid />
        </div>

        <div class="form-group">
          <label class="font-bold">Pertenece al Campeonato (Opcional)</label>
          <Select v-model="form.championships" :options="championshipStore.items" optionLabel="name" optionValue="id" multiple placeholder="Selecciona campeonatos" fluid />
        </div>
      </div>

      <template #footer>
        <Button :label="t('common.cancel')" icon="pi pi-times" text @click="isModalOpen = false" severity="secondary" />
        <Button :label="t('common.save')" icon="pi pi-check" @click="handleSubmit" severity="primary" />
      </template>
    </Dialog>
  </div>
</template>
