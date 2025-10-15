import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/harvests/:collector_id?',
    name: 'harvests',
    component: () => import('../views/HarvestsPage.vue'),
  },
  {
    path: '/collector/:full_name?',
    name: 'collector',
    component: () => import('../views/CollectorPage.vue'),
  },
  {
    path: '/collector-edit/:id?',
    name: 'CollectorEdit',
    props: route => ({ id: route.params.id }),
    component: () => import('../views/CollectorEdit.vue'),
  },
  {
    path: '/harvests-edit/:id?',
    name: 'HarvestsEdit',
    props: route => ({ id: route.params.id }),
    component: () => import('../views/HarvestsEdit.vue'),
  },

  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: () => import('../views/CollectorPage.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
