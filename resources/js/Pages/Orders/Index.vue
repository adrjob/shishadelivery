<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import OrdersTable from "@/Components/Orders/OrdersTable.vue";
import { Link } from "@inertiajs/vue3"; // Importa o componente Link

defineProps({
    orders: Array,
});
</script>

<template>
    <AppLayout title="Orders">
        <template #header>
            <div class="flex justify-between items-center"> <!-- Adiciona um contêiner flex -->
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Orders
                </h2>
                <Link
                    :href="route('orders.trashed')"
                    as="button"
                    class="bg-[#feac40] text-white px-4 rounded-md"
                >
                    Trash
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto shadow-xl sm:rounded-lg">
                    <OrdersTable :orders="orders" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
