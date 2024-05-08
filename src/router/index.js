import { createRouter, createWebHistory } from 'vue-router'
import { isLogget, isAdmin } from '../servis/islogget.js';
import HomePage from '../views/HomePage.vue'
import LoginPage from '../views/LoginPage.vue'
import UsersPage from '../views/UsersPage.vue'
import UserPage from '../views/UserPage.vue'
import OrdersPage from '../views/OrdersPage.vue'
import OrdersUserPage from '../views/OrdersUsersPage.vue'
import ProvidersPage from '../views/ProvidersPage.vue'
import SettingsPage from '../views/SettingsPage.vue'
import sitePages from '../views/SitePages.vue'
import SitePage from '../views/SitePage.vue'

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
    path: '/orders/users',
    name: 'orders_user',
    meta: {
      requireAuth: true,
    },
    component: OrdersUserPage
  },
  {
    path: '/sitePages',
    name: 'sitePages',
    meta: {
      requireAuth: true,
    },
    component: sitePages
  },
  {
    path: '/page/:pageId([0-9]+)',
    name: 'page',
    meta: {
      requireAuth: true,
    },
    component: SitePage
  },
  {
    path: '/provaders',
    name: 'provaders',
    meta: {
      requireAuth: true,
    },
    component: ProvidersPage
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
  let logget = await isLogget();

  if(to.meta.requireAuth&&!logget) return {path: '/login'}
  if(!to.meta.requireAuth&&logget) return {path: '/'}
})

export default router
