import { defineStore } from 'pinia';
import api from '../api';

export const usePlayerStore = defineStore('player', {
  state: () => ({
    items: [],
    totalItems: 0,
    loading: false,
    error: null,
  }),
  actions: {
    async fetchAll(params = {}, force = false) {
      const hasFilters = Object.keys(params).length > 0;
      if (this.items.length > 0 && !hasFilters && !force) return;
      
      this.loading = true;
      try {
        // We use application/ld+json to get pagination metadata
        const response = await api.get('/players', { 
          params,
          headers: { 'Accept': 'application/ld+json' }
        });
        
        if (response.data && response.data['hydra:member']) {
          this.items = response.data['hydra:member'];
          this.totalItems = response.data['hydra:totalItems'] || this.items.length;
        } else if (response.data && response.data['member']) {
          this.items = response.data['member'];
          this.totalItems = response.data['totalItems'] || this.items.length;
        } else if (Array.isArray(response.data)) {
          this.items = response.data;
          this.totalItems = response.data.length;
        } else {
          console.error('Unexpected API response structure', response.data);
          this.items = [];
          this.totalItems = 0;
        }
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    },
    async create(data) {
      try {
        const response = await api.post('/players', data);
        this.items.push(response.data);
        return response.data;
      } catch (err) {
        this.error = err.message;
        throw err;
      }
    }
  }
});
