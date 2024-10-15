<!-- src/components/TablePlugin.vue -->
<template>
    <div class="overflow-x-auto">
      <div class="min-w-full overflow-hidden rounded-lg border border-gray-200 shadow-md dark:border-gray-700">
        <table class="min-w-full table-auto border-collapse bg-white text-left text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-400">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th v-for="column in columns" :key="column.label" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 text-xs md:text-sm lg:text-base">
                {{ column.label }}
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 border-t border-gray-100 dark:divide-gray-700 dark:border-gray-700">
            <tr v-for="row in rows" :key="row.id" class="hover:bg-gray-50 dark:hover:bg-gray-600">
              <td v-for="column in columns" :key="column.field" class="px-4 py-2 text-xs md:text-sm lg:text-base">
                {{ formatCell(row[column.field], column) }}
              </td>
              <td v-if="actions.length" class="px-4 py-2">
                <div class="flex justify-end gap-4">
                  <a v-for="action in actions" :key="action.name" :href="action.getLink(row)" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500">
                    <svg :viewBox="action.iconViewBox" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-6 h-6">
                      <path :d="action.iconPath" />
                    </svg>
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps } from "vue";
  
  const props = defineProps({
    rows: Array, // Dados das linhas da tabela
    columns: Array, // Definição das colunas da tabela
    actions: Array, // Lista de ações (botões de ação como ver, editar, etc)
  });
  
  // Função genérica para formatar as células da tabela
  function formatCell(value, column) {
    if (column.format) {
      return column.format(value);
    }
    return value;
  }
  </script>
  
  <style>
  .overflow-x-auto {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  
  table {
    min-width: 100%;
  }
  </style>
  