<template>
    <AppLayout title="Shipments">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Shipments
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Adiciona a classe overflow-x-auto para permitir o scroll horizontal no mobile -->
                    <div class="overflow-x-auto">
                        <ShipmentsTable :shipments="shipments" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ShipmentsTable from '@/Components/Shipment/ShipmentsTable.vue'; // Importa a tabela de envios (shipments)

defineProps({
    shipments: Array, // Define shipments como uma propriedade
});
</script>
