<template>
  <div class="flex flex-col h-screen">
    <nav class="bg-gray-800 text-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
        
          <!-- Left: Logo + Navigation -->
          <div class="w-full flex items-center justify-between">
          <!-- Logo -->
            <div class="flex">
              <NuxtLink to="/" class="text-xl font-bold hover:text-gray-300">
              Template HPP
            </NuxtLink>
            </div>

          <!-- Navigation Links -->
            <div class="flex space-x-4">
              <template v-if="!isLoggedIn">
                <NuxtLink to="/auth/login" class="hover:text-gray-300">Login</NuxtLink>
              </template>
              <template v-if="isLoggedIn">
                <NuxtLink to="/dashboard" class="hover:text-gray-300">Dashboard</NuxtLink>
                <NuxtLink @click.prevent="logoutUser" to="/" class="bg-red-600 px-3 py-1 rounded hover:bg-red-700">
                  Logout
                </NuxtLink>
                <span v-if="user" class="text-yellow-500">Welcome, {{user.name}}</span>
              </template>
            </div>
          </div>
        </div>
      </div>
    </nav>
      <slot/>
  </div>
</template>

<script setup lang="ts">
  interface User{
    name:string;
    email:string;
  }

  const{ isLoggedIn , user, logout} =  useSanctum<User>()

  function logoutUser(){
    logout()
  }

</script>