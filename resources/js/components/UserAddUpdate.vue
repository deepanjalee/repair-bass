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
                                for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >First name</label
                            >
                            <input
                                type="text"
                                id="first_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="First Name"
                                v-model="form.first_name"
                            />
                        </div>
                        <div>
                            <label
                                for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Last name</label
                            >
                            <input
                                type="text"
                                id="last_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Last Name"
                                v-model="form.last_name"
                            />
                        </div>
                        <div>
                            <label
                                for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Email</label
                            >
                            <input
                                type="text"
                                id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Email"
                                v-model="form.email"
                            />
                        </div>
                        <div>
                            <label
                                for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Mobile</label
                            >
                            <input
                                type="text"
                                id="mobile"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Mobile"
                                v-model="form.mobile"
                            />
                        </div>
                        <div>
                            <label
                                for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >NIC</label
                            >
                            <input
                                type="text"
                                id="nic"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="NIC"
                                v-model="form.nic"
                            />
                        </div>
                        <div>
                            <label
                                for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Salary par Day</label
                            >
                            <input
                                type="text"
                                id="salary_per_day"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Salary par Day"
                                v-model="form.salary_per_day"
                            />
                        </div>

                        <div>
                            <label
                                for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >User Type</label
                            >
                            <v-select
                                label="countryName"
                                :options="countries"
                            ></v-select>
                        </div>

                    </div>
                        <div>
                            <button type="submit"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive } from "vue";
import vSelect from "vue-select";
import useUsers from "../components/composables/users";

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
    },
    components: {
        vSelect,
    },

    setup() {
        const form = reactive({
            first_name: "",
            last_name: "",
            email: "",
            mobile: "",
            nic: "",
            salary_per_day: "",
        });

        const { errors, onSubmit } = useUsers();

        const saveCompany = async () => {
            await onSubmit({ ...form });
        };
        return {
            form,
            saveCompany,
        };
    },
};
</script>
