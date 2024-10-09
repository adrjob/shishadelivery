<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// Getting the order via props
const props = defineProps({
  order: Object, // The current order
});

// Using useForm for Inertia form submission
const form = useForm({
  tracking_number: '',
  carrier: '',
  shipping_date: '',
  delivery_estimate: '',
  shipping_status: 'Order Received',
});

// Function to submit the form
const submitForm = () => {
  form.post(route('shipments.store', props.order.id));
};
</script>

<template>
  <AppLayout title="Create Shipment for Order #{{ order.order_id }}">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        Create Shipment for Order #{{ order.order_id }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
          <form @submit.prevent="submitForm">
            <div class="mb-4">
              <label for="tracking_number" class="block font-semibold text-gray-700 dark:text-gray-300">Tracking Number:</label>
              <input type="text" v-model="form.tracking_number" id="tracking_number" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white" />
            </div>

            <div class="mb-4">
              <label for="carrier" class="block font-semibold text-gray-700 dark:text-gray-300">Carrier:</label>
              <input type="text" v-model="form.carrier" id="carrier" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white" />
            </div>

            <div class="mb-4">
              <label for="shipping_date" class="block font-semibold text-gray-700 dark:text-gray-300">Shipping Date:</label>
              <input type="date" v-model="form.shipping_date" id="shipping_date" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white" />
            </div>

            <div class="mb-4">
              <label for="delivery_estimate" class="block font-semibold text-gray-700 dark:text-gray-300">Delivery Estimate:</label>
              <input type="date" v-model="form.delivery_estimate" id="delivery_estimate" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white" />
            </div>

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

            <button type="submit" class="bg-[#feac40] text-white px-4 py-2 rounded-md">Create Shipment</button>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Add your styles here */
</style>
