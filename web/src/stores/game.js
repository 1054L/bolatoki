import { defineStore } from 'pinia';
import api from '../api';

export const useGameStore = defineStore('game', {
  state: () => ({
    items: [],
    loading: false,
    error: null,
  }),
  actions: {
    async fetchAll() {
      this.loading = true;
      try {
        const response = await api.get('/games');
        this.items = response.data;
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    },
    async create(data) {
      try {
        const response = await api.post('/games', data);
        this.items.push(response.data);
        return response.data;
      } catch (err) {
        this.error = err.message;
        throw err;
      }
    }
  }
});
