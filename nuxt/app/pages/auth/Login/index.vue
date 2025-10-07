<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-md p-8">
      <!-- Title -->
      <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
        Login to Your Account
      </h2>

      <!-- Form -->
      <form @submit.prevent="submitForm">
        <!-- Email -->
        <div class="pt-2">
          <label for="email" class="block text-sm font-medium text-gray-700">
            Email
          </label>
          <input
            type="email"
            id="email"
            v-model="form.email"
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
        </div>

        <!-- Password -->
        <div class="pt-2 pb-10">
          <label for="password" class="block text-sm font-medium text-gray-700">
            Password
          </label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
        </div>

        <!-- Remember me + Forgot password -->
        <!-- <div class="flex items-center justify-between text-sm pt-5 pb-5">
          <label class="flex items-center space-x-2">
            <input type="checkbox" class="rounded border-gray-300">
            <span>Remember me</span>
          </label>
          <NuxtLink to="/forgot-password" class="text-blue-600 hover:underline">
            Forgot password?
          </NuxtLink>
        </div> -->

        <!-- Submit button -->
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg 
                 hover:bg-blue-700 transition-colors duration-200"
        >
          Login
        </button>
      </form>

      <!-- Divider -->
      <div class="my-6 border-t border-gray-200"></div>

      <!-- Register link -->
        <p class="text-sm text-center text-gray-600">
            Don’t have an account?
            <NuxtLink to="/auth/register" class="text-blue-600 hover:underline">
                Register
            </NuxtLink>
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">

  const { login } = useSanctum();

  const form = ref({
    email: '',
    password: ''
  });

  const submitForm = () => {
    login(form.value)
  };

  definePageMeta({
  middleware: ['$guest'],
});
</script>
