<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { defineProps, toRefs, computed } from "vue";
import RecentOrders from "@/Components/Orders/RecentOrdersTable.vue";
import RecentShipmentsTable from "@/Components/Shipment/RecentShipmentsTable.vue";

// Recebe as propriedades e usa toRefs para torná-las reativas
const props = defineProps({
    orders: Array, // Últimas 10 ordens
    clients: Array, // Últimos 10 clientes
    cashbacks: Array, // Últimos 10 cashbacks
    shipments: Array, // Últimos 10 envios
    totalOrders: Number, // Total de ordens
    totalClients: Number, // Total de clientes
    totalCashbacks: Number, // Total de cashbacks
    totalShipments: Number, // Total de envios
});

// Desestruturar as propriedades com toRefs
const { orders, clients, cashbacks, shipments, totalOrders, totalClients, totalCashbacks, totalShipments } = toRefs(props);
</script>

<template>
  <AppLayout title="Dashboard">
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              Dashboard
          </h2>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                  <!-- Card de Ordens -->
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                      <div class="text-gray-600 dark:text-gray-400 text-lg font-semibold">
                          Total Orders
                      </div>
                      <div class="mt-4 text-3xl font-bold text-gray-800 dark:text-white">
                          {{ totalOrders }}
                      </div>
                  </div>

                  <!-- Card de Clientes -->
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                      <div class="text-gray-600 dark:text-gray-400 text-lg font-semibold">
                          Total Clients
                      </div>
                      <div class="mt-4 text-3xl font-bold text-gray-800 dark:text-white">
                          {{ totalClients }}
                      </div>
                  </div>

                  <!-- Card de Cashbacks -->
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                      <div class="text-gray-600 dark:text-gray-400 text-lg font-semibold">
                          Total Cashbacks
                      </div>
                      <div class="mt-4 text-3xl font-bold text-gray-800 dark:text-white">
                          {{ totalCashbacks }}
                      </div>
                  </div>

                  <!-- Card de Shipments -->
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                      <div class="text-gray-600 dark:text-gray-400 text-lg font-semibold">
                          Total Shipments
                      </div>
                      <div class="mt-4 text-3xl font-bold text-gray-800 dark:text-white">
                          {{ totalShipments }}
                      </div>
                  </div>
              </div>

              <!-- Tabela de Recent Orders -->
              <div class="mt-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                  <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                      Recent Orders
                  </h3>
                  <RecentOrders :orders="orders" />
              </div>

              <!-- Tabela de Recent Shipments -->
              <div class="mt-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                  <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                      Recent Shipments
                  </h3>
                  <RecentShipmentsTable :shipments="shipments" />
              </div>
          </div>
      </div>
  </AppLayout>
</template>
s