<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
  <AppLayout title="Home">
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              Home
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