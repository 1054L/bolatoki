<script setup>
import { ref, onMounted } from 'vue'
import { useChampionshipStore } from '../../stores/championship'
import { useModeStore } from '../../stores/mode'
import { usePointformatStore } from '../../stores/pointformat'
import { useI18n } from 'vue-i18n'

// PrimeVue Components
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import Select from 'primevue/select'
import DatePicker from 'primevue/datepicker'

const store = useChampionshipStore()
const modeStore = useModeStore()
const pointformatStore = usePointformatStore()
const { t } = useI18n()

const isModalOpen = ref(false)
const form = ref({
  name: '',
  mode: null,
  pointformat: null,
  startDate: new Date()
})

onMounted(() => {
  store.fetchAll()
  modeStore.fetchAll()
  pointformatStore.fetchAll()
})

const openModal = () => {
  form.value = { name: '', mode: null, pointformat: null, startDate: new Date() }
  isModalOpen.value = true
}

const handleSubmit = async () => {
  try {
    await store.create({
      name: form.value.name,
      mode: form.value.mode ? `/modes/${form.value.mode}` : null,
      pointformat: form.value.pointformat ? `/pointformats/${form.value.pointformat}` : null,
      startDate: form.value.startDate.toISOString()
    })
    isModalOpen.value = false
  } catch (err) {
    alert('Error al crear el campeonato')
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
      <h1 class="text-3xl font-bold m-0">{{ t('nav.championships') }}</h1>
      <Button :label="t('common.save')" icon="pi pi-plus" @click="openModal" severity="primary" />
    </div>

    <DataTable :value="store.items" :loading="store.loading" stripedRows class="p-datatable-sm card">
      <Column field="id" header="ID" style="width: 5rem">
        <template #body="slotProps">
          <span class="font-mono text-muted">#{{ slotProps.data.id }}</span>
        </template>
      </Column>
      
      <Column :header="t('nav.championships')">
        <template #body="slotProps">
          <div>
            <div class="font-bold text-lg">{{ slotProps.data.name }}</div>
            <div class="text-xs opacity-60">{{ formatDate(slotProps.data.startDate) }}</div>
          </div>
        </template>
      </Column>

      <Column header="Modalidad">
        <template #body="slotProps">
          <span class="badge">{{ slotProps.data.mode?.name || 'N/A' }}</span>
        </template>
      </Column>

      <Column header="Puntuación">
        <template #body="slotProps">
          {{ slotProps.data.pointformat?.name || 'Estándar' }}
        </template>
      </Column>

      <Column header="Estado">
        <template #body>
          <span class="status-pill success">Activo</span>
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

    <Dialog v-model:visible="isModalOpen" modal :header="'Nuevo Campeonato'" :style="{ width: '450px' }">
      <div style="display: flex; flex-direction: column; gap: 1.5rem; padding-top: 1rem;">
        <div class="form-group">
          <label for="name" class="font-bold">Nombre</label>
          <InputText id="name" v-model="form.name" placeholder="Ej: Torneo Verano 2024" fluid />
        </div>

        <div class="form-group">
          <label for="date" class="font-bold">Fecha de Inicio</label>
          <DatePicker id="date" v-model="form.startDate" dateFormat="dd/mm/yy" fluid />
        </div>

        <div class="form-group">
          <label for="mode" class="font-bold">Modalidad</label>
          <Select id="mode" v-model="form.mode" :options="modeStore.items" optionLabel="name" optionValue="id" placeholder="Selecciona una modalidad" fluid />
        </div>

        <div class="form-group">
          <label for="format" class="font-bold">Formato de Puntuación</label>
          <Select id="format" v-model="form.pointformat" :options="pointformatStore.items" optionLabel="name" optionValue="id" placeholder="Selecciona un formato" fluid />
        </div>
      </div>

      <template #footer>
        <Button :label="t('common.cancel')" icon="pi pi-times" text @click="isModalOpen = false" severity="secondary" />
        <Button :label="t('common.save')" icon="pi pi-check" @click="handleSubmit" severity="primary" />
      </template>
    </Dialog>
  </div>
</template>

<style scoped>
.badge {
  background: var(--bg-secondary);
  border: 1px solid var(--border-color);
  padding: 0.2rem 0.5rem;
  font-size: 0.7rem;
  font-weight: 600;
  border-radius: 2px;
}

.status-pill {
  font-size: 0.65rem;
  font-weight: 800;
  text-transform: uppercase;
  padding: 0.25rem 0.6rem;
  border-radius: 99px;
  letter-spacing: 0.05em;
}

.status-pill.success {
  background: rgba(20, 185, 147, 0.1);
  color: #14b993;
}

.btn-icon {
  background: transparent;
  border: 1px solid var(--border-color);
  width: 32px;
  height: 32px;
  margin-left: 0.5rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-icon:hover {
  border-color: var(--accent-primary);
  color: var(--accent-primary);
}

.btn-icon.danger:hover {
  border-color: var(--error);
  color: var(--error);
}
</style>
