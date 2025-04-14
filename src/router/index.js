import { createRouter, createWebHistory } from 'vue-router'
import { isLogget, isAdmin } from '../servis/islogget.js';
import HomePage from '../views/HomePage.vue'
import LoginPage from '../views/LoginPage.vue'
import UsersPage from '../views/UsersPage.vue'
import UserPage from '../views/UserPage.vue'
import OrdersPage from '../views/OrdersPage.vue'
import OrdersFreePage from '../views/OrdersFreePage.vue'
import OrdersUserPage from '../views/OrdersUsersPage.vue'
import ProvidersPage from '../views/ProvidersPage.vue'
import SettingsPage from '../views/SettingsPage.vue'
import sitePages from '../views/SitePages.vue'

const routes = [

  {
    path: '/login',
    name: 'login',
    meta: {
      requireAuth: false,
      requireAdmin: false,
    },
    component: LoginPage
  },
  {
    path: '/',
    name: 'home',
    meta: {
      requireAuth: true,
      requireAdmin: false,
    },
    component: HomePage
  },
  {
    path: '/users',
    name: 'users',
    meta: {
      requireAuth: true,
      requireAdmin: true,
    },
    component: UsersPage
  },
  {
    path: '/users/:userId([0-9]+)',
    name: 'user',
    meta: {
      requireAuth: true,
      requireAdmin: true,
    },
    component: UserPage
  },
  {
    path: '/orders',
    name: 'orders',
    meta: {
      requireAuth: true,
      requireAdmin: false,
    },
    component: OrdersPage
  },
  {
    path: '/free-orders',
    name: 'free_orders',
    meta: {
      requireAuth: true,
      requireAdmin: false,
    },
    component: OrdersFreePage
  },
  {
    path: '/orders/users',
    name: 'orders_user',
    meta: {
      requireAuth: true,
      requireAdmin: true,
    },
    component: OrdersUserPage
  },
  {
    path: '/sitePages',
    name: 'sitePages',
    meta: {
      requireAuth: true,
      requireAdmin: true,
    },
    component: sitePages
  },
  {
    path: '/provaders',
    name: 'provaders',
    meta: {
      requireAuth: true,
      requireAdmin: false,
    },
    component: ProvidersPage
  },
  {
    path: '/settings',
    name: 'settings',
    meta: {
      requireAuth: true,
      requireAdmin: true,
    },
    component: SettingsPage
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from) => {
  let logget = await isLogget();
  let Admin = await isAdmin();

  if(to.meta.requireAuth&&!logget) return {path: '/login'}
  if(!to.meta.requireAuth&&logget) return {path: '/'}

  if(to.meta.requireAdmin&&!Admin) return {path: '/home'}
})

export default router
