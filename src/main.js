import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import components from './components'

let baseUrl = 'https://smmbackmy.ru/php_admin/';
window.baseUrl = baseUrl;

const app = createApp(App)

components.forEach(component => {
    app.component(component.name, component)
})

app.use(router)

app.mount('#app')
