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
                                >Customer</label
                            >
                            <v-select
                                label="name"
                                v-model="form.customer_id"
                                placeholder="Select Customer"
                                :reduce="(customer) => customer.id"
                                :options="customers"
                                @update:modelValue="getSitesByCustomer"
                            ></v-select>
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900"
                                >Select Site</label
                            >
                            <v-select
                                label="name"
                                v-model="form.site_id"
                                placeholder="Select Site"
                                :reduce="(site) => site.id"
                                :options="sites.data"
                            ></v-select>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                Date</label
                            >
                            <datepicker
                                v-model="form.date"
                                class="rounded-md"
                                :clearable="true"
                                style="height: 33px"
                                :format="formatDate"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mt-5">
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                Description
                            </label>
                            <textarea
                                name="description"
                                cols="30"
                                rows="3"
                                v-model="form.description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            ></textarea>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900"
                            >
                                Payment Remarks
                            </label>
                            <textarea
                                name="remarks"
                                cols="30"
                                rows="3"
                                v-model="form.remarks"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            ></textarea>
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
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import Datepicker from "vue3-datepicker";
import { format } from "date-fns";

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
        Datepicker,
    },

    setup() {
        const form = reactive({
            quotation_number: "",
            customer_id: "",
            site_id: "",
            date: new Date(),
            sub_total: "",
            discount: "",
            discount_type: "",
            vat: "",
            total: "",
            description: "",
            remarks: "",
        });

        const { errors, onSubmit, sites, loading, fetchSites } =
            useQuotations();

        const getSitesByCustomer = (customerId) => {
            fetchSites(customerId); // Call API to load sites
        };

        const saveQuotation = async () => {
            await onSubmit({ ...form });
        };

        const formatDate = (date) => {
            return format(date, "yyyy-MM-dd"); // Formats date as 2025-02-25
        };

        return {
            form,
            saveQuotation,
            getSitesByCustomer,
            sites,
            loading,
            formatDate,
        };
    },
};
</script>

<style scoped>
.height-date {
    height: 32px;
}
</style>
