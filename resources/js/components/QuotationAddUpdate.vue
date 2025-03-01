<template>
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-5 mt-2">
        <div class="card">
            <div class="card-body">
                <div class="flex flex-row justify-between items-center">
                    <h1 class="font-extrabold text-lg text-gray-500">
                        {{ pageName }}
                    </h1>
                    <a
                        type="button"
                        href="/admin/users"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        {{ btnName }}
                    </a>
                </div>

                <form @submit.prevent="saveCompany">
                    <div class="grid grid-cols-2 gap-4 mt-5">
                        <div>
                            <label
                                for="quotation_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Quotation Number</label
                            >
                            <input
                                type="text"
                                id="quotation_number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Quotation Number"
                                v-model="form.quotation_number"
                            />
                        </div>
                        <div>
                            <label
                                for="quotation_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Quotation Number</label
                            >
                            <v-select label="name" v-model="form.customer_id" placeholder="Select Customer" :reduce="customer => customer.id"  :options="customers" ></v-select>
                        </div>
                    </div>
                    <div>
                        <button
                            type="submit"
                            class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive } from "vue";

import useQuotations from "../components/composables/quotations";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default {
    props: {
        pageName: {
            type: String,
            required: true,
        },
        btnName: {
            type: String,
            required: true,
        },
        customers: {
            type: Array,
            required: true,
        },
    },
    components: {
            vSelect,
    },

    setup() {
        const form = reactive({
            quotation_number: "",
            customer_id: "",
            site_id: "",
            date: "",
            sub_total: "",
            discount: "",
            discount_type: "",
            vat: "",
            total: "",
            description: "",
            remarks: "",
        });

        const { errors, onSubmit } = useQuotations();

        const saveQuotation = async () => {
            await onSubmit({ ...form });
        };
        return {
            form,
            saveQuotation,
        };
    },
};
</script>
