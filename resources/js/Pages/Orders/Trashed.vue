<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TrashedOrdersTable from '@/Components/Orders/TrashedOrdersTable.vue';

defineProps({
    orders: Array,
});
</script>

<template>
    <AppLayout title="Orders">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Trashed Orders
            </h2>
        </template>

        <div class="py-12">           
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-x-auto shadow-xl sm:rounded-lg">            
                    <TrashedOrdersTable :orders="orders" />
                </div>
            </div>
        </div>        
    </AppLayout>
</template>
