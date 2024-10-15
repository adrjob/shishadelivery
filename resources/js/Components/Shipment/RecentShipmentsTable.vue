<template>
    <div class="overflow-hidden rounded-lg mt-5 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 dark:bg-gray-800">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Order ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Tracking Number</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Carrier</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Shipping Status</th>
                    <th scope="col" class="px-6 py-4 text-center font-medium text-gray-900 dark:text-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:divide-gray-600 dark:border-gray-600">
                <tr v-for="shipment in shipments" :key="shipment.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 font-normal text-gray-900 dark:text-gray-100">#{{ shipment.order_id }}</td>
                    <td class="px-6 py-4">{{ shipment.tracking_number || 'N/A' }}</td>
                    <td class="px-6 py-4">{{ shipment.carrier || 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <span :class="getStatusClass(shipment.shipping_status, 'shipment')" class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold">
                            <span :class="getStatusColor(shipment.shipping_status, 'shipment')" class="h-1.5 w-1.5 rounded-full"></span>
                            {{ shipment.shipping_status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-4">
                            <!-- <a :href="`/shipments/${shipment.id}`" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600" title="View Shipment">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.16.48-.348.944-.562 1.387a11.957 11.957 0 01-8.98 5.95A11.957 11.957 0 012.458 12z" />
                                </svg>
                            </a> -->

                            <a :href="`/shipments/${shipment.id}/edit`" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600" title="Edit Shipment">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-1.036a2.5 2.5 0 113.536-3.536 2.5 2.5 0 01-3.536 3.536zm2 2l-9.7 9.7a1.5 1.5 0 01-.7.4l-4.2 1.2a.75.75 0 01-.925-.925l1.2-4.2a1.5 1.5 0 01.4-.7l9.7-9.7z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { getStatusClass, getStatusColor } from '@/Utils/statusHelpers';

// Define as propriedades que o componente receberá
const props = defineProps({
    shipments: Array, // Recebe os envios (shipments) como propriedade
});
</script>
