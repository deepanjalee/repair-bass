import { ref, watch } from "vue";
import axios from "axios";
export default function useQuotations() {
    const quotations = ref([]);
    const quotation = ref([]);
    const errors = ref("");
    const sites = ref([]);
    const loading = ref(false);
    const item = ref(false);
    const products = ref([]);

    const onSubmit = async (data) => {
        errors.value = "";
        try {
            const response = await axios.post("/api/customer/quotations", data);
            if (response.data.status && response.data.redirect_url) {
                window.location.href = response.data.redirect_url;
            }
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const fetchSites = async (customerId) => {
        try {
            loading.value = true;
            const response = await axios.get(
                `/api/admin/customer/sites/${customerId}`
            );
            sites.value = response.data;
        } catch (error) {
            console.error("Error fetching sites:", error);
            sites.value = []; // Reset sites on error
        } finally {
            loading.value = false;
        }
    };
   
    const fetchProductDetails = async (itemId, products, item) => {
        // try {
        const selectedProduct = products.find(
            (product) => product.id === itemId
        );
        item.item_name = selectedProduct.name;
        item.price = selectedProduct.price;
    };

    const calculateSubTotal = (items) => {
        return items.reduce((sum, item) => sum + Number(item.total || 0), 0);
    };

    const calculateTotal = (form) => {
        const subTotal = calculateSubTotal(form.items);
        let discount = 0;

        if (form.discount_type == 1) {
            // Flat discount
            discount = Number(form.discount || 0);
            form.discount = discount;
        } else if (form.discount_type == 2) {
            // Percentage discount
            discount = subTotal * (Number(form.discount_percentage || 0) / 100);
            form.discount = discount;
        }

        return subTotal - discount;
    };

    const addItemDetails = (item, form) => {
        // Find the item if it already exists
        const existingItem = form.items.find(
            (existing) => existing.item_id === item.item_id
        );

        if (existingItem) {
            // If exists, update the quantity and total
            existingItem.price = item.price; // Add new quantity (or add 1 if undefined)
            existingItem.quantity = item.quantity; // Add new quantity (or add 1 if undefined)
            existingItem.total = item.total;
        } else {
            // If doesn't exist, add it as new
            form.items.push({
                item_id: item.item_id,
                item_name: item.item_name,
                price: item.price,
                quantity: item.quantity,
                total: item.total,
                description: item.description,
            });
        }

        // Optional: Reset the input item
        item.item_id = "";
        item.item_name = "";
        item.price = null;
        item.quantity = null;
        item.total = 0;
        item.description = "";

        //calculate form sub total
        // form.sub_total = form.items.reduce((acc, item) => {
        //     return acc + (item.price * item.quantity);
        // }, 0);
    };

    return {
        onSubmit,
        quotations,
        quotation,
        errors,
        fetchSites,
        sites,
        loading,
        item,
        fetchProductDetails,
        addItemDetails,
        calculateSubTotal,
        calculateTotal,
    };
}
