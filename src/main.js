import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

let baseUrl = 'https://smmbackmy.ru/php_admin/';
window.baseUrl = baseUrl;

const app = createApp(App)

app.use(router)

app.mount('#app')
