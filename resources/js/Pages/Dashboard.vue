<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';

// Pegando os dados passados pelo controlador Laravel
const { props } = usePage();
const recentOrders = props.recentOrders || [];
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Dashboard - Recent Orders
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
          <h3 class="text-lg font-semibold mb-4">Recent Orders</h3>

          <table class="min-w-full table-auto bg-white">
            <thead>
              <tr>
                <th class="px-4 py-2">Order ID</th>
                <th class="px-4 py-2">Customer Name</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Date Created</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="order in recentOrders" :key="order.order_id" class="border-b">
                <td class="border px-4 py-2">{{ order.order_id }}</td>
                <td class="border px-4 py-2">{{ order.customer_name }}</td>
                <td class="border px-4 py-2">{{ `$${order.total.toFixed(2)}` }}</td>
                <td class="border px-4 py-2">{{ order.status }}</td>
                <td class="border px-4 py-2">{{ new Date(order.date_created).toLocaleDateString() }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
