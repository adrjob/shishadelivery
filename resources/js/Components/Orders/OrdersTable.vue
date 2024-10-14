<template>
    <div class="overflow-x-auto">
        <div class="min-w-full overflow-hidden rounded-lg border border-gray-200 shadow-md dark:border-gray-700">
            <table class="min-w-full table-auto border-collapse bg-white text-left text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">Order ID</th>
                        <th scope="col" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">Customer</th>
                        <th scope="col" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">Date</th>
                        <th scope="col" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">Order Status</th>
                        <th scope="col" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">Shipment Status</th>
                        <th scope="col" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">Total</th>
                        <th scope="col" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:divide-gray-700 dark:border-gray-700">
                    <tr v-for="order in orders" :key="order.id" class="hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">#{{ order.order_id }}</td>
                        <td class="px-4 py-2 text-xs md:text-sm lg:text-base">{{ order.customer_name }}</td>
                        <td class="px-4 py-2 text-xs md:text-sm lg:text-base">{{ formatDate(order.created_at) }}</td>
                        <td class="px-4 py-2">
                            <span :class="getStatusClass(order.status, 'order')" class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold">
                                <span :class="getStatusColor(order.status, 'order')" class="h-1.5 w-1.5 rounded-full"></span>
                                {{ order.status }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <span :class="getStatusClass(order.shipment ? order.shipment.shipping_status : null, 'shipment')" class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold">
                                <span :class="getStatusColor(order.shipment ? order.shipment.shipping_status : null, 'shipment')" class="h-1.5 w-1.5 rounded-full"></span>
                                {{ order.shipment ? order.shipment.shipping_status : "No shipment" }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-xs md:text-sm lg:text-base">${{ typeof order.total === 'number' ? order.total.toFixed(2) : 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <div class="flex justify-end gap-4">
                                <a :href="`/orders/${order.id}`" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500" title="View Order">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.16.48-.348.944-.562 1.387a11.957 11.957 0 01-8.98 5.95A11.957 11.957 0 012.458 12z" />
                                    </svg>
                                </a>
                                <a :href="order.shipment ? `/shipments/${order.shipment.id}/edit` : `/orders/${order.id}/shipments/create`" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500" title="Manage Shipment">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h2.973c.354 0 .693-.186.882-.488l.64-.987A1.5 1.5 0 019.973 11h4.054a1.5 1.5 0 011.478 1.212l.64.987c.19.302.528.488.882.488H21m-3.82 4a2 2 0 100-4 2 2 0 000 4zm-10 0a2 2 0 100-4 2 2 0 000 4zM21 16v-3a1 1 0 00-1-1h-4.027a1 1 0 01-.988-.836l-.47-2.823A2 2 0 0012.538 8H9.462a2 2 0 00-1.977 1.341l-.47 2.823A1 1 0 016.027 13H3a1 1 0 00-1 1v3h19z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style>
.overflow-x-auto {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch; /* Suaviza o scroll no iOS */
}

table {
    min-width: 100%; /* Garante que a tabela tenha largura mínima suficiente */
}
</style>

<script setup>
import { defineProps } from "vue";

// Define as propriedades que o componente receberá
const props = defineProps({
    orders: Array, // Recebe as ordens como propriedade
});

function formatDate(value) {
    const date = new Date(value);
    return date.toLocaleDateString();
}

function getStatusClass(status, type) {
    if (
        (type === "order" && status === "completed") ||
        (type === "shipment" && status === "Delivered")
    ) {
        return "inline-flex items-center gap-1 rounded-full bg-green-50 text-green-600 px-2 py-1 text-xs font-semibold dark:bg-green-600 dark:text-green-100";
    }
    return "inline-flex items-center gap-1 rounded-full bg-yellow-50 text-yellow-600 px-2 py-1 text-xs font-semibold dark:bg-yellow-600 dark:text-yellow-100";
}

function getStatusColor(status, type) {
    if (
        (type === "order" && status === "completed") ||
        (type === "shipment" && status === "Delivered")
    ) {
        return "h-1.5 w-1.5 rounded-full bg-green-600 dark:bg-green-100";
    }
    return "h-1.5 w-1.5 rounded-full bg-yellow-600 dark:bg-yellow-100";
}
</script>
