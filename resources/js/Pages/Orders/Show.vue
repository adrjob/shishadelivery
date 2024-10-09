<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

defineProps({
    order: Object, // Recebemos a ordem como uma prop
    shipment: Object, // Recebemos o envio como uma prop
});
</script>

<template>
    <AppLayout title="Order Details">
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Order #{{ order.order_id }}
            </h2>
            <p class="text-base text-gray-600 dark:text-gray-300">Placed on {{ new Date(order.date_created).toLocaleDateString() }}</p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Caixa de detalhes da ordem -->
                <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 space-y-8">
                    
                    <!-- Itens do Pedido -->
                    <div>
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Order Items</h3>
                        <div v-for="item in order.items" :key="item.id" class="mt-4 p-4 border-t border-gray-200 dark:border-gray-600">
                            <div class="flex items-start space-x-4">
                                <div class="w-16 h-16">
                                    <img :src="item.image_url" alt="Product Image" class="rounded-lg w-full h-full object-cover" />
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ item.product_name }}</h4>
                                    <p class="text-gray-500 dark:text-gray-400">Quantity: {{ item.quantity }}</p>
                                    <p class="text-gray-500 dark:text-gray-400">Price: ${{ item.price }}</p>
                                    <p class="text-gray-700 dark:text-gray-300 font-semibold">Total: ${{ item.total }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informações da Ordem -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Resumo da Ordem -->
                        <div class="p-4 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
                            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Order Summary</h3>
                            <div class="mt-4">
                                <p class="text-lg"><strong>Total:</strong> ${{ order.total }}</p>
                                <p class="text-lg"><strong>Status:</strong> {{ order.status }}</p>
                            </div>
                        </div>

                        <!-- Informações de Pagamento -->
                        <div class="p-4 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
                            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Payment Information</h3>
                            <div class="mt-4">
                                <p class="text-lg"><strong>Payment Method:</strong> {{ order.payment_method_title }}</p>
                                <p class="text-lg"><strong>Date Paid:</strong> {{ order.date_paid || 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Informações de Faturamento -->
                        <div class="p-4 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
                            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Delivery Information</h3>
                            <div class="mt-4">
                                <p class="text-lg"><strong>Name:</strong> {{ order.customer_name }}</p>
                                <p class="text-lg"><strong>Email:</strong> {{ order.billing_email }}</p>
                                <p class="text-lg"><strong>Phone:</strong> {{ order.billing_phone }}</p>
                                <p class="text-lg">
                                    <strong>Address:</strong> 
                                    {{ order.billing_address_1 }} {{ order.billing_address_2 }},
                                    {{ order.billing_city }}, {{ order.billing_state }},
                                    {{ order.billing_postcode }}, {{ order.billing_country }}
                                </p>
                            </div>
                        </div>

                        <!-- Timeline da Ordem -->
                        <div class="p-4 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
                            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Order Timeline</h3>
                            <div class="mt-4">
                                <p class="text-lg"><strong>Date Created:</strong> {{ order.date_created }}</p>
                                <p class="text-lg"><strong>Date Modified:</strong> {{ order.date_modified }}</p>
                                <p class="text-lg"><strong>Date Completed:</strong> {{ order.date_completed || 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Resumo Final -->
                    <div class="mt-8 p-6 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Order Overview</h3>
                        <p class="text-lg"><strong>Total:</strong> ${{ order.total }}</p>
                    </div>

                    <!-- Seção de Envio (Shipment) -->
                    <div class="mt-8 p-6 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Shipment Details</h3>
                        <p class="text-lg"><strong>Tracking Number:</strong> {{ shipment.tracking_number || 'N/A' }}</p>
                        <p class="text-lg"><strong>Carrier:</strong> {{ shipment.carrier || 'N/A' }}</p>
                        <p class="text-lg"><strong>Shipping Status:</strong> {{ shipment.shipping_status }}</p>
                        <p class="text-lg"><strong>Shipping Date:</strong> {{ shipment.shipping_date ? new Date(shipment.shipping_date).toLocaleDateString() : 'N/A' }}</p>
                        <p class="text-lg"><strong>Delivery Estimate:</strong> {{ shipment.delivery_estimate ? new Date(shipment.delivery_estimate).toLocaleDateString() : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
