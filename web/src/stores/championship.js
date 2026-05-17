import { defineStore } from 'pinia';
import api from '../api';

export const useChampionshipStore = defineStore('championship', {
  state: () => ({
    items: [],
    loading: false,
    error: null,
  }),
  actions: {
    async fetchAll(force = false) {
      if (this.items.length > 0 && !force) return;
      
      this.loading = true;
      try {
        const response = await api.get('/championships');
        this.items = response.data;
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    },
    async create(data) {
      try {
        const response = await api.post('/championships', data);
        this.items.push(response.data);
        return response.data;
      } catch (err) {
        this.error = err.message;
        throw err;
      }
    }
  }
});
