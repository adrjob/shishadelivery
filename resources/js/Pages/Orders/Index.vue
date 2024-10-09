<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import OrdersTable from '@/Components/Orders/OrdersTable.vue';

defineProps({
    orders: Array,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Orders
            </h2>
        </template>

        <div class="py-12">           
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">            
                    <OrdersTable :orders="orders" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
