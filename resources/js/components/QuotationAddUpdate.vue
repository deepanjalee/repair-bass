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

                <form @submit.prevent="saveQuotation">
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
                                :disabled="update"
                            />
                        </div>
                        <div>
                            <label
                                for="quotation_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Customer {{ update }} </label
                            >
                            <v-select
                                label="name"
                                v-model="form.customer_id"
                                placeholder="Select Customer"
                                :reduce="(customer) => customer.id"
                                :options="customers"
                                @update:modelValue="getSitesByCustomer"
                                :disabled="form.customer_id != '' && update == true"
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
                                for="quotation_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Discount Type</label
                            >
                            <v-select
                                label="name"
                                v-model="form.discount_type"
                                placeholder="Select Dicount Type"
                                :reduce="(discountType) => discountType.id"
                                :options="discountTypes"
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
                                Remarks
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

                    <div class="grid grid-cols-1 gap-4 mt-5 mb-5">
                        <section>
                            <div>
                                <!-- Start coding here -->
                                <div
                                    class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden"
                                >
                                    <div
                                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
                                    >
                                        <div class="mt-2">
                                            <h5>Add Item</h5>
                                        </div>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table
                                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                        >
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                            >
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3"
                                                        style="width: 30%"
                                                    >
                                                        Item
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3"
                                                    >
                                                        Price
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3"
                                                    >
                                                        Quantity
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3"
                                                    >
                                                        Total
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3"
                                                    >
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    class="border-b dark:border-gray-700"
                                                >
                                                    <td class="px-4 py-3">
                                                        <v-select
                                                            label="name"
                                                            v-model="
                                                                item.item_id
                                                            "
                                                            placeholder="Select Product"
                                                            :reduce="
                                                                (product) =>
                                                                    product.id
                                                            "
                                                            :options="products"
                                                            @update:modelValue="
                                                                setProductDetails
                                                            "
                                                        ></v-select>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <input
                                                            v-model="item.price"
                                                            type="number"
                                                            id="price"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Price"
                                                            @input="
                                                                formatPriceInput
                                                            "
                                                            min="0"
                                                        />
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <input
                                                            v-model="
                                                                item.quantity
                                                            "
                                                            type="number"
                                                            id="quantity"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Quantity"
                                                            min="1"
                                                            @input="
                                                                validateQuantity
                                                            "
                                                        />
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <input
                                                            :value="
                                                                formatCurrency(
                                                                    item.total
                                                                )
                                                            "
                                                            type="text"
                                                            id="total"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="total"
                                                            disabled
                                                        />
                                                    </td>
                                                    <td
                                                        class="px-4 py-3 flex items-center justify-end"
                                                    ></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="mx-4 my-2">
                                                            <textarea
                                                                name="description"
                                                                cols="30"
                                                                rows="3"
                                                                placeholder="Description"
                                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            ></textarea>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                                            @click="addItem"
                                                        >
                                                            <svg
                                                                class="w-6 h-6 text-white"
                                                                aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke="currentColor"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 12h14m-7 7V5"
                                                                />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr
                                                    v-for="(
                                                        item, index
                                                    ) in form.items"
                                                    :key="index"
                                                    class="border-b dark:border-gray-700"
                                                >
                                                    <td class="px-4 py-3">
                                                        {{ item.item_name }}
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        {{
                                                            formatCurrency(
                                                                item.price
                                                            )
                                                        }}
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        {{ item.quantity }}
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        LKR
                                                        {{
                                                            formatCurrency(
                                                                item.total
                                                            )
                                                        }}
                                                    </td>
                                                    <td
                                                        class="px-4 py-3 flex items-center justify-end"
                                                    ></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="overflow-x-auto mt-4">
                                        <table
                                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                        >
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                            >
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3 text-right"
                                                    >
                                                        Sub Total:
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3 text-right"
                                                    >
                                                        LKR
                                                        {{
                                                            formatCurrency(
                                                                form.sub_total
                                                            )
                                                        }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3 text-right"
                                                    >
                                                        Discount :
                                                        <label
                                                          v-if="
                                                                form.discount_type ==
                                                                2
                                                            "
                                                        >
                                                           (%)
                                                        </label>
                                                        <br />
                                                        <label
                                                            for=""
                                                            class="text-red-400"
                                                            v-if="
                                                                form.discount_type ==
                                                                ''
                                                            "
                                                            >* Please Select
                                                            Discount Type
                                                            first</label
                                                        >
                                                    </th>
                                                    <td
                                                        style="width: 30%"
                                                        scope="col"
                                                        class="px-4 py-3 text-right"
                                                    >
                                                        <input
                                                            v-if="
                                                                form.discount_type ==
                                                                1
                                                            "
                                                            :disabled="
                                                                form.discount_type ===
                                                                ''
                                                            "
                                                            type="number"
                                                            v-model="
                                                                form.discount
                                                            "
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Discount"
                                                        />
                                                        <input
                                                            v-if="
                                                                form.discount_type ==
                                                                2
                                                            "
                                                            :disabled="
                                                                form.discount_type ===
                                                                ''
                                                            "
                                                            type="number"
                                                            v-model="
                                                                form.discount_percentage
                                                            "
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Discount"
                                                        />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-4 py-3 text-right"
                                                    >
                                                        Total:
                                                    </th>
                                                    <td
                                                        style="width: 30%"
                                                        scope="col"
                                                        class="px-4 py-3 text-right"
                                                    >
                                                        <input
                                                            type="text"
                                                            :value="
                                                                formatCurrency(
                                                                    form.total
                                                                )
                                                            "
                                                            disabled
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Total"
                                                        />
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
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
import { reactive, computed, watch } from "vue";

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
        quotationNumber: {
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
        products: {
            type: Array,
            required: true,
        },
        discountTypes: {
            type: Array,
            required: true,
        },
        update: {
            type: Boolean,
            required: true,
        },

        quotation: {
            type: Object,
            default: () => ({}),
        },
       
    },
    components: {
        vSelect,
        Datepicker,
    },

    setup(props) {
        const form = reactive({
            quotation_number: "",
            customer_id: "",
            site_id: "",
            date: new Date(),
            sub_total: 0,
            discount: 0,
            discount_percentage: 0,
            discount_type: "",
            vat: 0,
            total: 0,
            description: "",
            remarks: "This quotation is valid for a period of 14 days from the date of issue.",
            items: [],
            id: "",
        });
        const item = reactive({
            item_id: "",
            item_name: "",
            price: null,
            quantity: null,
            total: 0,
            description: "",
        });

        const {
            errors,
            onSubmit,
            sites,
            loading,
            fetchSites,
            fetchProductDetails,
            addItemDetails,
            calculateSubTotal,
            calculateTotal,
        } = useQuotations();

        const getSitesByCustomer = (customerId) => {
            // Reset site_id when customer changes
            form.site_id = "";
            fetchSites(customerId);
        };

        const subTotal = computed(() => calculateSubTotal(form.items));
        watch(subTotal, (newVal) => {
            form.sub_total = newVal;
        });

        const total = computed(() => calculateTotal(form));
        watch(total, (newVal) => {
            form.total = newVal;
        });
        watch(
            () => [item.price, item.quantity],
            () => {
                if (item.price && item.quantity) {
                    item.total = item.price * item.quantity;
                } else {
                    item.total = 0;
                }
            },
            { immediate: true }
        );

        watch(
            () => props.update,
            (val) => {
                if (val && props.quotation) {
                    form.quotation_number =
                        props.quotation.quotation_number ||  props.quotationNumber;
                    form.id =
                        props.quotation.id || "";
                    form.customer_id = props.quotation.customer_id || "";
                    form.site_id = props.quotation.site_id || "";
                    form.date = props.quotation.date
                        ? new Date(props.quotation.date)
                        : new Date();
                    form.sub_total = props.quotation.sub_total || 0;
                    form.discount = props.quotation.discount || "";
                    form.discount_percentage = props.quotation.discount_percentage || "";
                    form.discount_type = props.quotation.discount_type || "";
                    form.vat = props.quotation.vat || 0;
                    form.total = props.quotation.total || 0;
                    form.description = props.quotation.description || "";
                    form.remarks = props.quotation.remarks || "This quotation is valid for a period of 14 days from the date of issue.";
                    form.items = props.quotation.items
                        ? JSON.parse(JSON.stringify(props.quotation.items))
                        : [];
                    
                    // Load sites if customer_id exists
                    if (form.customer_id) {
                        fetchSites(form.customer_id);
                    }
                }
            },
            { immediate: true }
        );

        const setProductDetails = (itemId) => {
            fetchProductDetails(itemId, props.products, item);
        };
        const loadSitesUpdate = (sites) => {
            loadSiteData(sites);
        };

        // Add item to the form
        const addItem = () => {
            addItemDetails(item, form);
        };

        const saveQuotation = async () => {
            await onSubmit({ ...form });
        };

        const formatDate = (date) => {
            return format(date, "yyyy-MM-dd"); // Formats date as 2025-02-25
        };

        const formatCurrency = (value) => {
            if (value == null) return "0.00";
            return Number(value).toLocaleString("en-LK", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        };

        const formatPriceInput = (event) => {
            // Remove any non-numeric characters except decimal point
            let value = event.target.value.replace(/[^\d.]/g, "");

            // Ensure only one decimal point
            const parts = value.split(".");
            if (parts.length > 2) {
                value = parts[0] + "." + parts.slice(1).join("");
                console.log("value parts", value);
            }

            // Format the number with thousand separators and 2 decimal places
            if (value) {
                const num = parseFloat(value);
                if (!isNaN(num) && num >= 0) {
                    // Only allow non-negative values
                    // Update total when price changes
                    if (item.quantity) {
                        item.total = num * item.quantity;
                    }
                    item.price = num;
                }
            }
        };

        const validateQuantity = (event) => {
            const value = parseInt(event.target.value);
            if (value < 1) {
                item.quantity = 1; // Set minimum value to 1
            }
            // Update total when quantity changes
            if (item.price) {
                item.total = item.price * item.quantity;
            }
        };

        return {
            form,
            saveQuotation,
            getSitesByCustomer,
            sites,
            loading,
            formatDate,
            item,
            setProductDetails,
            addItem,
            formatCurrency,
            formatPriceInput,
            validateQuantity,
            loadSitesUpdate,
        };
    },
};
</script>

<style scoped>
.height-date {
    height: 32px;
}
</style>
