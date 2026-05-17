import { defineStore } from 'pinia';
import api from '../api';

export const useClubStore = defineStore('club', {
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
        const response = await api.get('/clubs');
        this.items = response.data;
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    }
  }
});
