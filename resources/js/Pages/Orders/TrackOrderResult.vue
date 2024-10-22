<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { useRouter } from "vue-router";
import { defineProps } from 'vue';

// Função para voltar à página anterior
const router = useRouter();
const goBack = () => {
    router.back();
};

defineProps({
    order: Object, // Recebemos a ordem como uma prop
    shipment: Object, // Recebemos o envio como uma prop
});

</script>

<template>
    <Head title="Order Shipment Status" />

    <div class="justify-center items-center bg-gray-50 dark:bg-gray-900 min-h-screen text-black/50 dark:text-white/50 flex flex-col">

        <!-- Detalhes da Ordem e do Shipment -->
        <div class="flex flex-col justify-center items-center">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                Shipment Status for Order #{{ order.order_id }}
            </h1>
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 w-full max-w-2xl">
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                    <strong>Order ID:</strong> {{ order.order_id }}
                </p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                    <strong>Order Status:</strong> {{ order.status || 'Pending' }}
                </p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                    <strong>Shipment Status:</strong> {{ shipment.status || 'Pending' }}
                </p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                    <strong>Estimated Delivery:</strong> {{ shipment.estimated_delivery || 'Not Available' }}
                </p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">
                    <strong>Tracking Number:</strong> {{ shipment.tracking_number || 'Not Available' }}
                </p>
            </div>
        </div>
    </div>
</template>
