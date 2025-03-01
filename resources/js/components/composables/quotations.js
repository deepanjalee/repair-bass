import { ref } from 'vue'
import axios from "axios";
export default function useQuotations() {
    const quotations = ref([])
    const quotation = ref([])
    const errors = ref('')

    const onSubmit = async (data) => {
        errors.value = ''
        try {
            // await axios.post('/api/admin/users', data)
            //await router.push({name: 'companies.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    return {
        onSubmit,
        quotations,
        quotation,
        errors
    }

}
