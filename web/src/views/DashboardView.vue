<script setup>
import { onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useChampionshipStore } from '../stores/championship'
import Card from 'primevue/card'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'

const { t } = useI18n()
const championshipStore = useChampionshipStore()

onMounted(() => {
  championshipStore.fetchAll()
})
</script>

<template>
  <div class="p-4">
    <h1 class="text-3xl font-bold mb-8">{{ t('dashboard.title') }}</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
      <Card>
        <template #title>
          <span class="text-sm uppercase text-muted font-bold">{{ t('dashboard.active_championships') }}</span>
        </template>
        <template #content>
          <div class="text-5xl font-black text-primary">{{ championshipStore.items.length }}</div>
        </template>
      </Card>

      <Card>
        <template #title>
          <span class="text-sm uppercase text-muted font-bold">{{ t('dashboard.registered_players') }}</span>
        </template>
        <template #content>
          <div class="text-5xl font-black text-primary">156</div>
        </template>
      </Card>

      <Card>
        <template #title>
          <span class="text-sm uppercase text-muted font-bold">{{ t('dashboard.games_today') }}</span>
        </template>
        <template #content>
          <div class="text-5xl font-black text-primary">24</div>
        </template>
      </Card>
    </div>

    <Card style="margin-top: 3rem;">
      <template #title>
        <h2 class="m-0">{{ t('dashboard.recent_activity') }}</h2>
      </template>
      <template #content>
        <DataTable :value="[
          { event: 'Nueva Partida', entity: 'Game #452', date: 'Hace 5 mins', user: 'Admin' },
          { event: 'Registro Jugador', entity: 'Iosu L.', date: 'Hace 20 mins', user: 'Admin' }
        ]" stripedRows class="mt-4">
          <Column field="event" header="Evento"></Column>
          <Column field="entity" header="Entidad"></Column>
          <Column field="date" header="Fecha"></Column>
          <Column field="user" header="Usuario"></Column>
        </DataTable>
      </template>
    </Card>
  </div>
</template>
