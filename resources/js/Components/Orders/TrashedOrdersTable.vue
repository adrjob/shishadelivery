<template>
    <div class="overflow-hidden rounded-lg shadow-md dark:border-gray-700">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-400">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 text-center">Order ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 text-center">Customer</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 text-center">Date</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 text-center">Order Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 text-center">Shipment Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 text-center">Total</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:divide-gray-700 dark:border-gray-700">
                <tr v-for="order in orders" :key="order.id" class="hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-normal text-gray-900 dark:text-gray-200 text-center">#{{ order.order_id }}</td>
                    <td class="px-6 py-4 text-center">{{ order.customer_name }}</td>
                    <td class="px-6 py-4 text-center">{{ formatDate(order.created_at) }}</td>
                    <td class="px-6 py-4 text-center">
                        <span :class="getStatusClass(order.status, 'order')" class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold">
                            <span :class="getStatusColor(order.status, 'order')" class="h-1.5 w-1.5 rounded-full"></span>
                            {{ order.status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span :class="getStatusClass(order.shipment ? order.shipment.shipping_status : null, 'shipment')" class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold">
                            <span :class="getStatusColor(order.shipment ? order.shipment.shipping_status : null, 'shipment')" class="h-1.5 w-1.5 rounded-full"></span>
                            {{ order.shipment ? order.shipment.shipping_status : "No shipment" }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">${{ typeof order.total === "number" ? order.total.toFixed(2) : "N/A" }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-4">
                            <a v-if="!order.deleted_at" :href="`/orders/${order.id}`" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500" title="View Order">
                                <!-- Ícone de visualização -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.16.48-.348.944-.562 1.387a11.957 11.957 0 01-8.98 5.95A11.957 11.957 0 012.458 12z" />
                                </svg>
                            </a>
                            <a v-else @click.prevent="openRestoreModal(order.id)" class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-500" title="Restore Order">
                                <!-- Ícone de restauração -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582a7.37 7.37 0 00-.082-1A7 7 0 014 9V4zm12 5V4a7 7 0 015.834 5.834c-.132.958-.376 1.875-.706 2.748H20z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20v-7.867a2.734 2.734 0 011.17-.177l.68-.068a6.5 6.5 0 10-6.204 7.825h.68v-5H4z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal de Confirmação para Restaurar Pedido -->
        <div v-if="isRestoringModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold">Confirm Restore</h2>
                <p>Are you sure you want to restore this order?</p>
                <div class="flex justify-end mt-4">
                    <button @click="closeRestoreModal" class="mr-2 px-4 py-2 text-gray-600 bg-gray-200 rounded">Cancel</button>
                    <button @click="confirmRestoreOrder" class="px-4 py-2 text-white bg-green-600 rounded">Ok</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useForm } from '@inertiajs/vue3';
import { getStatusClass, getStatusColor } from '@/Utils/statusHelpers'; // Importa as funções do utils

// Define as propriedades que o componente receberá
const props = defineProps({
    orders: Array, // Recebe as ordens como propriedade
});

// Formulário usando useForm para restaurar pedidos
const restoreForm = useForm({ _method: 'POST' });
const isRestoringModalOpen = ref(false);
const currentOrderId = ref(null);

// Função para formatar a data
function formatDate(value) {
    const date = new Date(value);
    return date.toLocaleDateString();
}

// Função para abrir o modal de restauração
function openRestoreModal(id) {
    currentOrderId.value = id;
    isRestoringModalOpen.value = true;
}

// Função para fechar o modal de restauração
function closeRestoreModal() {
    isRestoringModalOpen.value = false;
    currentOrderId.value = null;
}

// Função para confirmar a restauração da ordem
function confirmRestoreOrder() {
    isRestoringModalOpen.value = false;
    restoreForm.post(`/orders/${currentOrderId.value}/restore`);
}
</script>
