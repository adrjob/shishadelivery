<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

// Obtém os erros e mensagens da sessão
const { props } = usePage();
const errors = props.errors || {};
const successMessage = props.flash?.success;

// Configurando o formulário com useForm para enviar os dados
const form = useForm({
    order_id: "",    
});

// Função para submeter o formulário e redirecionar ou disparar alerta
const submitForm = () => {
    form.post(route('order.checkShipment', { order_id: form.order_id }), {
        onError: (errors) => {
            console.log(errors);
        },
        onSuccess: (response) => {
            if (response.shipment_exists) {
                // Redireciona para a página de status da ordem
                window.location.href = response.redirect_url;
            }
        },
    });
};
</script>

<template>
    <Head title="Track Your Order" />

    <div class="bg-gray-50 dark:bg-gray-900 text-black/50 dark:text-white/50 min-h-screen flex flex-col justify-center items-center">
        <div class="text-center max-w-3xl mb-8">
            <img src="/images/logo-200.png" alt="App Logo" class="h-32 w-32 mx-auto mb-6" />
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">Track Your Order</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                Enter your order details to track the shipment and status of your order.
            </p>
        </div>

        <!-- Formulário de rastreio de pedido -->
        <div class="flex flex-col justify-center items-center mb-12">
            <form @submit.prevent="submitForm" class="space-y-6">
                <!-- Order ID -->
                <div>
                    <label for="order_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order ID</label>
                    <input
                        type="text"
                        id="order_id"
                        v-model="form.order_id"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm dark:bg-gray-700 dark:text-white"
                    />
                </div>
                
                <!-- Botão de envio -->
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="w-full px-4 py-2 bg-[#FF7B37] text-white rounded-md hover:bg-red-500"
                    >
                        Track Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
