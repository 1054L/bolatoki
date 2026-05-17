<script setup>
import { ref, onMounted } from 'vue'
import { useFieldStore } from '../../stores/field'
import { useI18n } from 'vue-i18n'

// PrimeVue Components
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'

const store = useFieldStore()
const { t } = useI18n()

const isModalOpen = ref(false)
const form = ref({
  name: '',
  location: ''
})

onMounted(() => {
  store.fetchAll()
})

const openModal = () => {
  form.value = { name: '', location: '' }
  isModalOpen.value = true
}

const handleSubmit = async () => {
  try {
    // Basic implementation for now
    // await store.create(form.value)
    isModalOpen.value = false
    alert('Funcionalidad de guardado en desarrollo')
  } catch (err) {
    alert('Error al crear el bolatoki')
  }
}
</script>

<template>
  <div class="p-4">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
      <h1 class="text-3xl font-bold m-0">{{ t('nav.bolatokis') }}</h1>
      <Button :label="'Nuevo Bolatoki'" icon="pi pi-plus" @click="openModal" severity="primary" />
    </div>

    <DataTable :value="store.items" stripedRows class="p-datatable-sm card">
      <Column field="id" header="ID" style="width: 5rem">
        <template #body="slotProps">
          <span class="font-mono text-muted">#{{ slotProps.data.id }}</span>
        </template>
      </Column>
      
      <Column field="name" header="Nombre" sortable></Column>
      <Column field="location" header="Ubicación" sortable></Column>

      <Column :header="t('common.actions')" style="text-align: right">
        <template #body>
          <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
            <Button icon="pi pi-pencil" severity="secondary" text rounded />
            <Button icon="pi pi-trash" severity="danger" text rounded />
          </div>
        </template>
      </Column>
    </DataTable>

    <Dialog v-model:visible="isModalOpen" modal header="Nuevo Bolatoki" :style="{ width: '400px' }">
      <div style="display: flex; flex-direction: column; gap: 1.5rem; padding-top: 1rem;">
        <div class="form-group">
          <label class="font-bold">Nombre del Bolatoki</label>
          <InputText v-model="form.name" placeholder="Ej: Bolatoki San Miguel" fluid />
        </div>
        <div class="form-group">
          <label class="font-bold">Ubicación / Ciudad</label>
          <InputText v-model="form.location" placeholder="Ej: Hernani" fluid />
        </div>
      </div>
      <template #footer>
        <Button label="Cancelar" icon="pi pi-times" text @click="isModalOpen = false" />
        <Button label="Guardar" icon="pi pi-check" @click="handleSubmit" />
      </template>
    </Dialog>
  </div>
</template>
