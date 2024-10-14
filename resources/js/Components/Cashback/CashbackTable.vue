<template>
    <div class="overflow-hidden rounded-lg shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 dark:bg-gray-800">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Order ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">TRX Wallet</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Cashback Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:divide-gray-600 dark:border-gray-600">
                <tr v-for="cashback in cashbacks" :key="cashback.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 font-normal text-gray-900 dark:text-gray-100">#{{ cashback.order.order_id }}</td>
                    <td class="px-6 py-4">{{ cashback.trx_wallet }}</td>
                    <td class="px-6 py-4">
                        <span :class="getStatusClass(cashback.status, 'cashback')" class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold">
                            <span :class="getStatusColor(cashback.status, 'cashback')" class="h-1.5 w-1.5 rounded-full"></span>
                            {{ cashback.status === 'paid' ? 'Paid' : 'Pending' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-end gap-4">
                            <button v-if="cashback.status === 'pending'" @click="markAsPaid(cashback.id)" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500" title="Mark as Paid">
                                Mark as Paid
                            </button>
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
import { router } from '@inertiajs/vue3';

// Define as propriedades que o componente receberá
const props = defineProps({
    cashbacks: Array, // Recebe os cashbacks como propriedade
});

// Função para marcar o cashback como pago
function markAsPaid(id) {
    router.put(`/cashbacks/${id}/mark-paid`);
}
</script>
