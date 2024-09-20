import './bootstrap'
import Swal from 'sweetalert2'
import { createApp } from 'vue'
import TestComponent from './components/TestComponent.vue'

const app = createApp()

app.component('test-component', TestComponent)

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
