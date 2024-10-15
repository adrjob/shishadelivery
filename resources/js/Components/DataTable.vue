<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
      <!-- Campo de pesquisa -->
      <div class="p-4">
        <input
          v-model="search"
          @input="filterData"
          type="text"
          placeholder="Search..."
          class="w-full p-2 border rounded-md"
        />
      </div>
  
      <!-- Tabela -->
      <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
          <tr>
            <th v-for="column in columns" :key="column.key" class="px-6 py-4 font-medium text-gray-900">
              {{ column.label }}
            </th>
            <th class="px-6 py-4"></th> <!-- Coluna para ações -->
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
          <tr v-for="item in filteredData" :key="item.id" class="hover:bg-gray-50">
            <td v-for="column in columns" :key="column.key" class="px-6 py-4">
              {{ item[column.key] }}
            </td>
            <td class="px-6 py-4">
              <div class="flex justify-end gap-4">
                <a @click="editItem(item.id)" href="#" class="text-blue-500">Edit</a>
                <a @click="deleteItem(item.id)" href="#" class="text-red-500">Delete</a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Paginação -->
      <div class="p-4">
        <pagination
          :current-page="currentPage"
          :last-page="lastPage"
          @change-page="changePage"
        />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      columns: Array, // Colunas da tabela
      data: Array, // Dados da tabela
      currentPage: Number, // Página atual
      lastPage: Number, // Última página
    },
    data() {
      return {
        search: '', // Valor do campo de pesquisa
        filteredData: this.data, // Dados filtrados
      };
    },
    watch: {
      // Atualiza os dados filtrados quando a lista de dados ou a pesquisa mudar
      data() {
        this.filterData();
      },
    },
    methods: {
      filterData() {
        // Filtra os dados baseado no campo de pesquisa
        this.filteredData = this.data.filter((item) =>
          Object.values(item).some((value) =>
            String(value).toLowerCase().includes(this.search.toLowerCase())
          )
        );
      },
      editItem(id) {
        this.$emit('edit-item', id); // Evento para edição
      },
      deleteItem(id) {
        this.$emit('delete-item', id); // Evento para exclusão
      },
      changePage(page) {
        this.$emit('change-page', page); // Evento para mudar página
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilização pode ser personalizada conforme necessário */
  </style>
  