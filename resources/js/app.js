import 'sweetalert2/src/sweetalert2.scss'

import '~/auth'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import PaginationPlugin from 'vue3-basic-pagination' // import component // register default styles

import App from './App.vue'
import router from './router'

const app = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.use(router)
app.use(PaginationPlugin)
app.mount('#app')
