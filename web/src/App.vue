<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink, RouterView } from 'vue-router'
import { useUserStore } from './stores/user'
import { useI18n } from 'vue-i18n'

const userStore = useUserStore()
const { t, locale } = useI18n()
const isSidebarOpen = ref(true)

onMounted(() => {
  userStore.fetchProfile()
})

const changeLanguage = (lang) => {
  locale.value = lang
  userStore.updateLocale(lang)
}

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
}
</script>

<template>
  <aside class="sidebar" :class="{ collapsed: !isSidebarOpen }">
    <div class="logo" style="padding: 1.5rem; background: var(--accent-primary); margin-bottom: 1rem;">
      <img src="/logo.png" alt="Bolatoki Logo" style="width: 100%; height: auto;">
    </div>
    <nav>
      <ul>
        <li>
          <RouterLink to="/">{{ t('nav.dashboard') }}</RouterLink>
        </li>
        <li>
          <RouterLink to="/championships">{{ t('nav.championships') }}</RouterLink>
        </li>
        <li>
          <RouterLink to="/games">{{ t('nav.games') }}</RouterLink>
        </li>
        <li>
          <RouterLink to="/players">{{ t('nav.players') }}</RouterLink>
        </li>
        <li v-if="userStore.isSuperAdmin">
          <RouterLink to="/clubs">{{ t('nav.clubs') }}</RouterLink>
        </li>
        <li v-if="userStore.isSuperAdmin">
          <RouterLink to="/bolatokis">{{ t('nav.bolatokis') || 'Bolatokis' }}</RouterLink>
        </li>
      </ul>
    </nav>
    <div style="margin-top: auto; font-size: 0.7rem; color: rgba(255, 255, 255, 0.5);">
      Admin v1.0.0
    </div>
  </aside>

  <main class="main-content" :class="{ expanded: !isSidebarOpen }">
    <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center;">
      <div style="display: flex; align-items: center; gap: 1.5rem;">
        <button @click="toggleSidebar" class="toggle-btn">
          <span v-if="isSidebarOpen">←</span>
          <span v-else>☰</span>
        </button>
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em;">
          Gestión de Entidades
        </div>
      </div>
      
      <div style="display: flex; align-items: center; gap: 2rem;">
        <div class="lang-switcher" style="display: flex; gap: 0.5rem;">
          <button @click="changeLanguage('eu')" :class="{ active: locale === 'eu' }" class="lang-btn">EU</button>
          <button @click="changeLanguage('es')" :class="{ active: locale === 'es' }" class="lang-btn">ES</button>
          <button @click="changeLanguage('en')" :class="{ active: locale === 'en' }" class="lang-btn">EN</button>
        </div>

        <div class="user-profile" style="display: flex; align-items: center; gap: 1rem;">
          <span style="font-size: 0.9rem;">{{ userStore.profile?.name || 'Admin' }}</span>
          <div style="width: 32px; height: 32px; background: var(--accent-primary); border-radius: 2px;"></div>
        </div>
      </div>
    </header>


    <RouterView v-slot="{ Component }">
      <transition name="view" mode="out-in">
        <component :is="Component" />
      </transition>
    </RouterView>
  </main>
</template>

<style scoped>
/* Scoped styles if needed, but most are in style.css */
</style>
