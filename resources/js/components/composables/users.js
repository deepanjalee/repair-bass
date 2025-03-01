import { ref } from 'vue'
import axios from "axios";
export default function useUsers() {
    const users = ref([])
    const user = ref([])
    const errors = ref('')

    const onSubmit = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/admin/users', data)
            //await router.push({name: 'companies.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    return {
        onSubmit,
        users,
        user,
        errors
    }

}
