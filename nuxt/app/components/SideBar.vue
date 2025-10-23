<script setup lang="ts">
import { ref } from 'vue';
import adminLogo from '~/assets/images/Logo.png';
import 'primeicons/primeicons.css'

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
  <aside class="w-64 bg-gray-800 text-white p-4 flex flex-col h-full">
    <div class="w-auto">
      <img :src="adminLogo" alt="Logo da Dashboard"/>
    </div>
 
    <NuxtLink  to="/dashboard" class="text-2xl font-bold  border-b border-gray-700 pb-3 hover:text-gray-300">
        Template HPP
  </NuxtLink>
    <ul class=" space-y-3 overflow-y-auto">
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
    <div class="flex flex-col mt-auto">
      <div class=" mb-2 text-justify cursor-default tracking-tight ">
        <span class=" font-light text-sm ">Welcome </span>
        <span v-if="user" class=" font-medium"> {{user.name}} </span>
      </div>
        <NuxtLink @click.prevent="logoutUser" to="/" class="bg-red-600 p-2 items-center rounded-md mt-auto overflow-y-auto  hover:bg-red-700">
        Logout 
      </NuxtLink>
    </div>
   
  </aside>
</template>