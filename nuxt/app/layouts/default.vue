<template>
    <div class="h-screen">
        <nav class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        
        <!-- Left: Logo + Navigation -->
        <div class="flex items-center space-x-4">
          <!-- Logo -->
          <NuxtLink to="/" class="text-xl font-bold hover:text-gray-300">
            Template HPP
          </NuxtLink>

          <!-- Navigation Links -->
          <div class="hidden md:flex space-x-4">
            <NuxtLink to="/" class="hover:text-gray-300">Home</NuxtLink>
            <NuxtLink to="/auth/login" class="hover:text-gray-300">Login</NuxtLink>
            <NuxtLink to="/auth/register" class="hover:text-gray-300">Register</NuxtLink>
            <NuxtLink to="/dashboard" class="hover:text-gray-300">Dashboard</NuxtLink>
          </div>
        </div>

        <!-- Right: Username + Logout -->
        <div class="flex items-center space-x-4">
          <span class="hidden sm:inline">Welcome, Henrique</span>
          <NuxtLink 
            to="/logout" 
            class="bg-red-600 px-3 py-1 rounded hover:bg-red-700"
          >
            Logout
          </NuxtLink>
        </div>
      </div>
    </div>
        </nav>

        <slot/>
    </div>
</template>