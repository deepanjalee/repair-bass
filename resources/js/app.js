import './bootstrap'
import Swal from 'sweetalert2'
import { createApp } from 'vue'
import UserAddUpdate from './components/UserAddUpdate.vue'

const app = createApp()

app.component('user-add-update', UserAddUpdate)

window.addEventListener('sweetalert', (event) => {
  let data = event.detail
  Swal.fire({
    position: data.position,
    icon: data.icon,
    title: data.title,
    showConfirmButton: false,
    timer: data.timer,
  })
})

app.mount('#app')
