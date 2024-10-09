<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

// Getting the shipment via props
const props = defineProps({
  shipment: Object, // The current shipment
});

// Using useForm for Inertia form submission
const form = useForm({
  shipping_status: props.shipment.shipping_status,
});

// Function to submit the form
const submitForm = () => {
  form.post(route('shipments.updateStatus', props.shipment.id));
};
</script>

<template>
  <AppLayout title="Update Shipment Status for Shipment #{{ shipment.order_id }}">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Update Shipment Status for Shipment #{{ shipment.order_id }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
          <form @submit.prevent="submitForm">
            <div class="mb-4">
              <label for="shipping_status" class="block font-semibold text-gray-700 dark:text-gray-300">Shipping Status:</label>
              <select v-model="form.shipping_status" id="shipping_status" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                <option value="Order Received">Order Received</option>
                <option value="Processing">Processing</option>
                <option value="Shipped">Shipped</option>
                <option value="Awaiting Delivery">Awaiting Delivery</option>
                <option value="Delivered">Delivered</option>
                <option value="Cancelled">Cancelled</option>
              </select>
            </div>

            <button type="submit" class="bg-[#feac40] text-white px-4 py-2 rounded-md">Update Status</button>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Add your styles here */
</style>
