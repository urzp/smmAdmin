import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import LoginPage from '../views/LoginPage.vue'
import UsersPage from '../views/UsersPage.vue'
import UserPage from '../views/UserPage.vue'
import OrdersPage from '../views/OrdersPage.vue'
import ProvadersPage from '../views/ProvadersPage.vue'
import SettingsPage from '../views/SettingsPage.vue'

const routes = [

  {
    path: '/login',
    name: 'login',
    meta: {
      requireAuth: false,
    },
    component: LoginPage
  },
  {
    path: '/',
    name: 'home',
    meta: {
      requireAuth: true,
    },
    component: HomePage
  },
  {
    path: '/users',
    name: 'users',
    meta: {
      requireAuth: true,
    },
    component: UsersPage
  },
  {
    path: '/users/:userId([0-9]+)',
    name: 'user',
    meta: {
      requireAuth: true,
    },
    component: UserPage
  },
  {
    path: '/orders',
    name: 'orders',
    meta: {
      requireAuth: true,
    },
    component: OrdersPage
  },
  {
    path: '/provaders',
    name: 'provaders',
    meta: {
      requireAuth: true,
    },
    component: ProvadersPage
  },
  {
    path: '/settings',
    name: 'settings',
    meta: {
      requireAuth: true,
    },
    component: SettingsPage
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from) => {
  //let logget = await isLogget();
  let logget = false;
  if(to.meta.requireAuth&&!logget) return {path: '/login'}
  if(!to.meta.requireAuth&&logget) return {path: '/'}
})

export default router
