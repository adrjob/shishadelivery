<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ClientsTable from '@/Components/Clients/ClientsTable.vue';

defineProps({
    clients: Array,
});
</script>

<template>
    <AppLayout title="Clients">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                Clients
            </h2>
        </template>

        <div class="py-12">           
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-x-auto shadow-xl sm:rounded-lg">            
                    <ClientsTable :clients="clients" />
                </div>
            </div>
        </div>        
    </AppLayout>
</template>
