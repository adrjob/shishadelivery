<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";

// Função para lidar com possíveis erros ao carregar a imagem
function handleImageError() {
    document.getElementById("background")?.classList.add("!hidden");
}

// Obtém os erros e mensagens da sessão
const { props } = usePage();
const errors = props.errors || {};
const successMessage = props.flash?.success;

// Configurando o formulário com useForm para enviar os dados
const form = useForm({
    order_id: '',
    email: '',
    trx_wallet: ''
});

// Função para submeter o formulário
const submitForm = () => {
    form.post(route('cashback.store'), {
        onError: (errors) => {
            console.log(errors);
        },
        onSuccess: (page) => {
            form.reset(); // Reseta o formulário após o sucesso
        }
    });
};
</script>

<template>
    <Head title="Add Order Information" />
    <div
        class="bg-gray-50 dark:bg-gray-900 text-black/50 dark:text-white/50 min-h-screen flex flex-col justify-center items-center"
    >
        <!-- Logo Centralizada -->
        <div class="flex justify-center mb-8">
            <img
                src="/images/logo.png"
                alt="App Logo"
                class="h-16 w-auto lg:h-20"
            />
        </div>

        <!-- Exibir Mensagens de Sucesso ou Erro -->
        <div v-if="Object.keys(errors).length > 0" class="mb-4 text-red-500 text-center">
            <!-- Iterar sobre os erros e exibi-los -->
            <ul>
                <li v-for="(error, index) in Object.values(errors)" :key="index">
                    {{ error }}
                </li>
            </ul>
        </div>
        <div v-if="successMessage" class="mb-4 text-green-500 text-center">
            {{ successMessage }}
        </div>

        <!-- Card com Formulário -->
        <main class="flex flex-col items-center justify-center w-full px-6">
            <div
                class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6"
            >
                <h1
                    class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4"
                >
                    Register Your Wallet
                </h1>
                <form @submit.prevent="submitForm" class="space-y-6">
                    <!-- Order ID -->
                    <div>
                        <label
                            for="order_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Order ID</label
                        >
                        <input
                            type="text"
                            id="order_id"
                            v-model="form.order_id"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm dark:bg-gray-700 dark:text-white"
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Email</label
                        >
                        <input
                            type="email"
                            id="email"
                            v-model="form.email"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm dark:bg-gray-700 dark:text-white"
                        />
                    </div>

                    <!-- Carteira TRX -->
                    <div>
                        <label
                            for="trx_wallet"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >TRX Wallet</label
                        >
                        <input
                            type="text"
                            id="trx_wallet"
                            v-model="form.trx_wallet"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm dark:bg-gray-700 dark:text-white"
                        />
                    </div>

                    <!-- Botão de envio -->
                    <div class="flex justify-center">
                        <button
                            type="submit"
                            class="w-full px-4 py-2 bg-[#FF7B37] text-white rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            :disabled="form.processing"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</template>
