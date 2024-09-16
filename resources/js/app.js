import './bootstrap'
import Swal from 'sweetalert2'

// Swal.fire({
//   position: 'top-end',
//   icon: 'success',
//   title: 'Your work has been saved',
//   showConfirmButton: false,
//   timer: 1500,
// })
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
