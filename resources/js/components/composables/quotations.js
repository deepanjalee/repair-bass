import { ref, watch } from "vue";
import axios from "axios";
export default function useQuotations() {
    const quotations = ref([]);
    const quotation = ref([]);
    const errors = ref("");
    const sites = ref([]);
    const loading = ref(false);

    const onSubmit = async (data) => {
        errors.value = "";
        try {
            // await axios.post('/api/admin/users', data)
            //await router.push({name: 'companies.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const fetchSites = async (customerId) => {

        try {
            loading.value = true;
            const response = await axios.get(`/api/admin/customer/sites/${customerId}`);
           sites.value = response.data;


        } catch (error) {
            console.error("Error fetching sites:", error);
        } finally {
            loading.value = false;
        }
    };




    return {
        onSubmit,
        quotations,
        quotation,
        errors,
        fetchSites,
        sites,
        loading,
    };
}
