<script setup>
import { ref, onMounted } from 'vue'
import { usePlayerStore } from '../../stores/player'
import { useClubStore } from '../../stores/club'
import { useI18n } from 'vue-i18n'

// PrimeVue Components
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import Select from 'primevue/select'
import Checkbox from 'primevue/checkbox'
import Tag from 'primevue/tag'

const store = usePlayerStore()
const clubStore = useClubStore()
const { t } = useI18n()

const isModalOpen = ref(false)
const lazyParams = ref({
  first: 0,
  rows: 20,
  page: 1,
  filters: {
    name: { value: null, matchMode: 'contains' },
    surname: { value: null, matchMode: 'contains' },
    gender: { value: null, matchMode: 'equals' },
    province: { value: null, matchMode: 'contains' },
    'club.name': { value: null, matchMode: 'contains' },
    federated: { value: null, matchMode: 'equals' }
  }
})

const form = ref({
  name: '',
  surname: '',
  gender: 1,
  province: '',
  club: null,
  federated: true
})

const genders = [
  { label: 'Masculino', value: 1 },
  { label: 'Femenino', value: 2 }
]

const loadLazyData = () => {
  const params = {
    page: lazyParams.value.page,
    name: lazyParams.value.filters.name.value,
    surname: lazyParams.value.filters.surname.value,
    gender: lazyParams.value.filters.gender.value,
    province: lazyParams.value.filters.province.value,
    'club.name': lazyParams.value.filters['club.name'].value,
    federated: lazyParams.value.filters.federated.value
  }
  
  // Remove null params
  Object.keys(params).forEach(key => (params[key] == null) && delete params[key])
  
  store.fetchAll(params)
}

onMounted(() => {
  loadLazyData()
  clubStore.fetchAll()
})

const onPage = (event) => {
  lazyParams.value = event
  lazyParams.value.page = event.page + 1
  loadLazyData()
}

const onFilter = (event) => {
  lazyParams.value.filters = event.filters
  lazyParams.value.page = 1
  loadLazyData()
}

const openModal = () => {
  form.value = { name: '', surname: '', gender: 1, province: '', club: null, federated: true }
  isModalOpen.value = true
}

const handleSubmit = async () => {
  try {
    const payload = {
      ...form.value,
      club: form.value.club ? `/clubs/${form.value.club}` : null
    }
    await store.create(payload)
    isModalOpen.value = false
    loadLazyData() // Refresh list
  } catch (err) {
    alert('Error al crear el jugador')
  }
}
</script>

<template>
  <div class="p-4">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
      <h1 class="text-3xl font-bold m-0">{{ t('nav.players') }}</h1>
      <Button :label="'Nuevo Jugador'" icon="pi pi-user-plus" @click="openModal" severity="primary" />
    </div>

    <DataTable 
      :value="store.items" 
      :lazy="true"
      :paginator="true" 
      :rows="lazyParams.rows" 
      :totalRecords="store.totalItems"
      :loading="store.loading" 
      @page="onPage($event)"
      @filter="onFilter($event)"
      filterDisplay="row"
      v-model:filters="lazyParams.filters"
      stripedRows 
      class="p-datatable-sm card"
    >
      <Column field="id" header="ID" style="width: 5rem">
        <template #body="slotProps">
          <span class="font-mono text-muted">#{{ slotProps.data.id }}</span>
        </template>
      </Column>
      
      <Column field="name" header="Nombre" :showFilterMenu="false">
        <template #filter="{ filterModel, filterCallback }">
          <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter" placeholder="Buscar por nombre" />
        </template>
      </Column>

      <Column field="surname" header="Apellidos" :showFilterMenu="false">
        <template #filter="{ filterModel, filterCallback }">
          <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter" placeholder="Buscar por apellidos" />
        </template>
      </Column>

      <Column header="Género" field="gender" :showFilterMenu="false" style="width: 10rem">
        <template #body="slotProps">
          <Tag :value="slotProps.data.gender === 1 ? 'Masculino' : 'Femenino'" 
               :severity="slotProps.data.gender === 1 ? 'info' : 'danger'" />
        </template>
        <template #filter="{ filterModel, filterCallback }">
          <Select v-model="filterModel.value" @change="filterCallback()" :options="genders" optionLabel="label" optionValue="value" placeholder="Todo" class="p-column-filter" style="min-width: 8rem" showClear />
        </template>
      </Column>

      <Column field="province" header="Provincia" :showFilterMenu="false">
        <template #filter="{ filterModel, filterCallback }">
          <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter" placeholder="Gipuzkoa..." />
        </template>
      </Column>

      <Column field="club.name" header="Club" :showFilterMenu="false">
        <template #body="slotProps">
          <span v-if="slotProps.data.club" class="font-semibold">{{ slotProps.data.club.name }}</span>
          <span v-else class="text-muted italic">Sin club</span>
        </template>
        <template #filter="{ filterModel, filterCallback }">
          <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter" placeholder="Buscar club" />
        </template>
      </Column>

      <Column field="federated" header="Federado" :showFilterMenu="false" style="width: 8rem">
        <template #body="slotProps">
          <Tag :severity="slotProps.data.federated ? 'success' : 'warn'" :value="slotProps.data.federated ? 'SÍ' : 'NO'" />
        </template>
        <template #filter="{ filterModel, filterCallback }">
          <Select v-model="filterModel.value" @change="filterCallback()" :options="[{label: 'SÍ', value: true}, {label: 'NO', value: false}]" optionLabel="label" optionValue="value" placeholder="Todo" class="p-column-filter" style="min-width: 6rem" showClear />
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

    <Dialog v-model:visible="isModalOpen" modal header="Nuevo Jugador" :style="{ width: '500px' }">
      <div style="display: flex; flex-direction: column; gap: 1.5rem; padding-top: 1rem;">
        <div style="display: flex; gap: 1rem;">
          <div class="form-group" style="flex: 1;">
            <label class="font-bold">Nombre</label>
            <InputText v-model="form.name" placeholder="Ej: Jon" fluid />
          </div>
          <div class="form-group" style="flex: 1;">
            <label class="font-bold">Apellidos</label>
            <InputText v-model="form.surname" placeholder="Ej: Garmendia" fluid />
          </div>
        </div>

        <div class="form-group">
          <label class="font-bold">Género</label>
          <Select v-model="form.gender" :options="genders" optionLabel="label" optionValue="value" fluid />
        </div>

        <div class="form-group">
          <label class="font-bold">Provincia / Localidad</label>
          <InputText v-model="form.province" placeholder="Ej: Gipuzkoa" fluid />
        </div>

        <div class="form-group">
          <label class="font-bold">Club</label>
          <Select v-model="form.club" :options="clubStore.items" optionLabel="name" optionValue="id" placeholder="Selecciona un club" fluid filter />
        </div>

        <div class="flex items-center gap-2">
          <Checkbox v-model="form.federated" binary inputId="fed" />
          <label for="fed" class="font-bold">Jugador Federado</label>
        </div>
      </div>

      <template #footer>
        <Button label="Cancelar" icon="pi pi-times" text @click="isModalOpen = false" severity="secondary" />
        <Button label="Guardar Jugador" icon="pi pi-check" @click="handleSubmit" severity="primary" />
      </template>
    </Dialog>
  </div>
</template>
