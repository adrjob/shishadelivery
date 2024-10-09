<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Analytics from '@/Components/AnalyticsComp.vue';
import { usePage } from '@inertiajs/vue3'; // Importando para acessar os dados passados pelo Laravel

const page = usePage();
const orders = page.props.orders; // Pegando os dados das orders do Laravel
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Analytics
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Passando os pedidos para o componente Analytics -->
                    <Analytics :orders="orders" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
