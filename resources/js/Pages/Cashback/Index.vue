<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CashbackTable from '@/Components/Cashback/CashbackTable.vue'

defineProps({
    cashbacks: Array, // Define cashbacks como uma propriedade
});
</script>

<template>
    <AppLayout title="Cashback">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Cashback
            </h2>
        </template>

        <div class="py-12">           
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">            
                    <CashbackTable :cashbacks="cashbacks" /> <!-- Passa a lista de cashbacks para o componente de tabela -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
