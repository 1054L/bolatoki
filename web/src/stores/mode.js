import { defineStore } from 'pinia';
import api from '../api';

export const useModeStore = defineStore('mode', {
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
        const response = await api.get('/modes');
        this.items = response.data;
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    }
  }
});
