<script setup>
import { Pie, Doughnut } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, CategoryScale, LinearScale } from 'chart.js';
import { computed } from 'vue';

// Registrar componentes do Chart.js
ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale, LinearScale);

// Definir as props
const props = defineProps({
  orders: {
    type: Array,
    required: true,
  },
});

// Computed property para o gráfico de pizza (Orders by Product)
const orderChartData = computed(() => {
  // Verificar se existem orders para evitar erros
  if (!props.orders || props.orders.length === 0) {
    return {
      labels: [],
      datasets: [{
        data: [],
        backgroundColor: []
      }]
    };
  }

  // Agrupar os dados por produto
  const productData = {};
  props.orders.forEach(order => {
    if (order.items) {
      order.items.forEach(item => {
        if (productData[item.product_name]) {
          productData[item.product_name] += parseFloat(item.total);
        } else {
          productData[item.product_name] = parseFloat(item.total);
        }
      });
    }
  });

  // Verificar se os dados de produtos foram preenchidos
  const labels = Object.keys(productData);
  const data = Object.values(productData);

  if (labels.length === 0 || data.length === 0) {
    return {
      labels: [],
      datasets: [{
        data: [],
        backgroundColor: []
      }]
    };
  }

  return {
    labels,
    datasets: [{
      data,
      backgroundColor: ['#4CAF50', '#FF6384', '#36A2EB', '#FFCE56']
    }]
  };
});

// Computed property para o gráfico de donut (Guest vs Non-Guest)
const guestChartData = computed(() => {
  if (!props.orders || props.orders.length === 0) {
    return {
      labels: ['Guest', 'Non-Guest'],
      datasets: [{
        data: [0, 0],
        backgroundColor: ['#36A2EB', '#FFCE56']
      }]
    };
  }

  let guestOrders = 0;
  let nonGuestOrders = 0;

  props.orders.forEach(order => {
    if (order.is_guest) {
      guestOrders += 1;
    } else {
      nonGuestOrders += 1;
    }
  });

  return {
    labels: ['Guest', 'Non-Guest'],
    datasets: [{
      data: [guestOrders, nonGuestOrders],
      backgroundColor: ['#36A2EB', '#FFCE56']
    }]
  };
});
</script>

<template>
  <div class="p-6 bg-gray-100 min-h-screen">
    <!-- Gráficos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <!-- Gráfico de Pizza -->
      <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Orders by Product</h2>
        <Pie :data="orderChartData" />
      </div>

      <!-- Gráfico de Donut -->
      <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Guest vs Non-Guest</h2>
        <Doughnut :data="guestChartData" />
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Customize seus estilos TailwindCSS aqui */
</style>
