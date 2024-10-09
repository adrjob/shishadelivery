<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table
            class="w-full border-collapse bg-white text-left text-sm text-gray-500"
        >
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                        Order ID
                    </th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                        Customer
                    </th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                        Order Status
                    </th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                        Shipment Status
                    </th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                        Total
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-4 font-medium text-gray-900"
                    ></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <tr
                    v-for="order in orders"
                    :key="order.id"
                    class="hover:bg-gray-50"
                >
                    <td class="px-6 py-4 font-normal text-gray-900">
                        #{{ order.order_id }}
                    </td>
                    <td class="px-6 py-4">{{ order.customer_name }}</td>
                    <td class="px-6 py-4">
                        {{ formatDate(order.created_at) }}
                    </td>
                    <td class="px-6 py-4">
                        <!-- Exibindo o status da ordem -->
                        <span
                            :class="getStatusClass(order.status, 'order')"
                            class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold"
                        >
                            <span
                                :class="getStatusColor(order.status, 'order')"
                                class="h-1.5 w-1.5 rounded-full"
                            ></span>
                            {{ order.status }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <!-- Exibindo o status da shipment -->
                        <span
                            :class="
                                getStatusClass(
                                    order.shipment
                                        ? order.shipment.shipping_status
                                        : null,
                                    'shipment'
                                )
                            "
                            class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold"
                        >
                            <span
                                :class="
                                    getStatusColor(
                                        order.shipment
                                            ? order.shipment.shipping_status
                                            : null,
                                        'shipment'
                                    )
                                "
                                class="h-1.5 w-1.5 rounded-full"
                            ></span>
                            {{
                                order.shipment
                                    ? order.shipment.shipping_status
                                    : "No shipment"
                            }}
                        </span>
                    </td>

                    <td class="px-6 py-4">${{ order.total.toFixed(2) }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-end gap-4">
                            <!-- Ícone de olho para visualizar o pedido -->
                            <a
                                :href="`/orders/${order.id}`"
                                class="text-blue-600 hover:text-blue-800"
                                title="View Order"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.16.48-.348.944-.562 1.387a11.957 11.957 0 01-8.98 5.95A11.957 11.957 0 012.458 12z"
                                    />
                                </svg>
                            </a>

                            <!-- Ícone de caminhão para gerenciar envio -->
                            <a
                                :href="
                                    order.shipment
                                        ? `/shipments/${order.shipment.id}/edit`
                                        : `/orders/${order.id}/shipments/create`
                                "
                                class="text-blue-600 hover:text-blue-800"
                                title="Manage Shipment"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 13h2.973c.354 0 .693-.186.882-.488l.64-.987A1.5 1.5 0 019.973 11h4.054a1.5 1.5 0 011.478 1.212l.64.987c.19.302.528.488.882.488H21m-3.82 4a2 2 0 100-4 2 2 0 000 4zm-10 0a2 2 0 100-4 2 2 0 000 4zM21 16v-3a1 1 0 00-1-1h-4.027a1 1 0 01-.988-.836l-.47-2.823A2 2 0 0012.538 8H9.462a2 2 0 00-1.977 1.341l-.47 2.823A1 1 0 016.027 13H3a1 1 0 00-1 1v3h19z"
                                    />
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

// Define as propriedades que o componente receberá
const props = defineProps({
    orders: Array, // Recebe as ordens como propriedade
});

// Função para formatar a data
function formatDate(value) {
    const date = new Date(value);
    return date.toLocaleDateString(); // Formata a data
}

function getStatusClass(status, type) {
    // Se for 'order' e o status for 'Completed', ou 'shipment' com status 'Delivered'
    if (
        (type === "order" && status === "completed") ||
        (type === "shipment" && status === "Delivered")
    ) {
        return "inline-flex items-center gap-1 rounded-full bg-green-50 text-green-600 px-2 py-1 text-xs font-semibold";
    }

    // Qualquer outro status
    return "inline-flex items-center gap-1 rounded-full bg-yellow-50 text-yellow-600 px-2 py-1 text-xs font-semibold";
}

function getStatusColor(status, type) {
    // Se for 'order' e o status for 'completed', ou 'shipment' com status 'Delivered'
    if (
        (type === "order" && status === "completed") ||
        (type === "shipment" && status === "Delivered")
    ) {
        return "h-1.5 w-1.5 rounded-full bg-green-600";
    }

    // Qualquer outro status
    return "h-1.5 w-1.5 rounded-full bg-yellow-600";
}
</script>
