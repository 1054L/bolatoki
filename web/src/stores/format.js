import { defineStore } from 'pinia';
import api from '../api';

export const useFormatStore = defineStore('format', {
  state: () => ({
    items: [],
  }),
  actions: {
    async fetchAll() {
      const response = await api.get('/formats');
      this.items = response.data;
    }
  }
});
