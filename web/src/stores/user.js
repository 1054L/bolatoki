import { defineStore } from 'pinia';
import api from '../api';
import i18n from '../i18n';

export const useUserStore = defineStore('user', {
  state: () => ({
    profile: null,
    loading: false,
  }),
  getters: {
    isSuperAdmin: (state) => state.profile?.roles?.includes('ROLE_SUPER_ADMIN'),
  },
  actions: {
    async fetchProfile() {
      this.loading = true;
      try {
        // Assuming we have a /me endpoint or just get user #1 for now as placeholder
        const response = await api.get('/users/1'); 
        this.profile = response.data;
        if (this.profile.locale) {
          i18n.global.locale.value = this.profile.locale;
        }
      } catch (err) {
        console.error('Failed to fetch profile', err);
      } finally {
        this.loading = false;
      }
    },
    async updateLocale(locale) {
      i18n.global.locale.value = locale;
      if (!this.profile) return;
      try {
        await api.patch(`/users/${this.profile.id}`, { locale }, {
          headers: { 'Content-Type': 'application/merge-patch+json' }
        });
        this.profile.locale = locale;
      } catch (err) {
        console.error('Failed to update locale', err);
      }
    }
  }
});
