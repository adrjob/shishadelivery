<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md dark:border-gray-700">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-400">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Client ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Name</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">Email</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:divide-gray-700 dark:border-gray-700">
                <tr v-for="client in clients" :key="client.id" class="hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-normal text-gray-900 dark:text-gray-200">#{{ client.id }}</td>
                    <td class="px-6 py-4">{{ client.name }}</td>
                    <td class="px-6 py-4">{{ client.email }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-end gap-4">
                            <!-- Ícone de olho para visualizar o cliente -->
                            <a :href="`/clients/${client.id}`" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500" title="View Client">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.16.48-.348.944-.562 1.387a11.957 11.957 0 01-8.98 5.95A11.957 11.957 0 012.458 12z" />
                                </svg>
                            </a>
                            <!-- Ícone de lápis para editar cliente -->
                            <a :href="`/clients/${client.id}/edit`" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500" title="Edit Client">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-1.036a2.5 2.5 0 113.536-3.536 2.5 2.5 0 01-3.536 3.536zm2 2l-9.7 9.7a1.5 1.5 0 01-.7.4l-4.2 1.2a.75.75 0 01-.925-.925l1.2-4.2a1.5 1.5 0 01.4-.7l9.7-9.7z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

// Define as propriedades que o componente receberá
const props = defineProps({
    clients: Array, // Recebe os clientes como propriedade
});
</script>
