import { createRouter, createWebHistory } from 'vue-router';
import DashboardView from '../views/DashboardView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: DashboardView,
    },
    {
      path: '/championships',
      name: 'championships',
      component: () => import('../views/entities/ChampionshipList.vue'),
    },
    {
      path: '/players',
      name: 'players',
      component: () => import('../views/entities/PlayerList.vue'),
    },
    {
      path: '/games',
      name: 'games',
      component: () => import('../views/entities/GameList.vue'),
    },
    {
      path: '/games/:id',
      name: 'game-detail',
      component: () => import('../views/entities/GameDetail.vue'),
    },
    {
      path: '/bolatokis',
      name: 'bolatokis',
      component: () => import('../views/entities/FieldList.vue'),
    },
  ],
});

export default router;
