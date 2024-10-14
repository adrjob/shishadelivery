<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ClientsTable from '@/Components/Clients/ClientsTable.vue'; // Importa a tabela de clientes

defineProps({
    clients: Array, // Define clients como uma propriedade
});
</script>

<template>
    <AppLayout title="Clients">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Clients
            </h2>
        </template>

        <div class="py-12">           
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">            
                    <ClientsTable :clients="clients" /> <!-- Passa a lista de clients para o componente de tabela -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
