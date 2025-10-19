<script setup lang="ts">
import { ref } from 'vue';

interface MenuItem {
    title: string;
    route: string; 
}

  interface User{
    name:string;
    email:string;
  }

const menuItems = ref<MenuItem[]>([
    { 
        title: 'Dashboard', 
        route: '/dashboard'
    },
    { 
        title: 'Gerenciar Produtos', 
        route: '/produtos'
    },
    { 
        title: 'Gerenciar Clientes', 
        route: '/clientes'
    },
    { 
        title: 'Pedidos de Compra', 
        route: '/compras'
    },
    { 
        title: 'Transações', 
        route: '/transacoes'
    },
    { 
        title: 'Configurações', 
        route: '/configuracoes'
    }, //TESTE: tirar em projeto real 
  
]);
 const{ isLoggedIn , user, logout} =  useSanctum<User>()

  function logoutUser(){
    logout()
  }
</script>

<template>
  <aside class="w-64 h-screen bg-gray-800 text-white p-10 flex flex-col">
    <NuxtLink  to="/" class="text-2xl font-bold mb-6 border-b border-gray-700 pb-4  hover:text-gray-300">
        Template HPP
  </NuxtLink>
 
    <ul class="space-y-2 overflow-y-auto">
      <li 
        v-for="item in menuItems" 
        :key="item.title"
      >
        <NuxtLink 
            :to="item.route" 
            :class="{ 
                'bg-blue-600': $route.path === item.route, 
                'hover:bg-gray-700': true
            }"
            class="flex items-center p-2 rounded-md transition-colors duration-200"
        >
            <span>{{ item.title }}</span>
        </NuxtLink>

      </li>
    </ul>
    <NuxtLink @click.prevent="logoutUser" to="/" class="bg-red-600 p-2 items-center rounded-md mt-3 overflow-y-auto  hover:bg-red-700">
            Logout
    </NuxtLink>
  </aside>
</template>