<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-md p-8">
      <!-- Title -->
      <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
        Register a new account
      </h2>

      <!-- Form -->
      <form>
        <!-- Email -->
        <div class="pt-2">
          <label for="name" class="block text-sm font-medium text-gray-700">
            Name
          </label>
          <input
            type="text"
            id="name"
            required
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
        </div>
        <div class="pt-2">
          <label for="email" class="block text-sm font-medium text-gray-700">
            Email
          </label>
          <input
            type="email"
            id="email"
            required
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
        </div>

        <!-- Password -->
        <div class="pt-2">
          <label for="password" class="block text-sm font-medium text-gray-700">
            Password
          </label>
          <input
            type="password"
            id="password"
            required
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
        </div>
        <div class="pt-2">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
            Password Confirmation
          </label>
          <input
            type="password"
            id="password_confirmation"
            required
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
        </div>

        <!-- Submit button -->
         <div class="pt-6">
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg 
                 hover:bg-blue-700 transition-colors duration-200"
        >
          Register
        </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
</script>
