<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-md p-8">
      <!-- Title -->
      <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
        Register a new account
      </h2>

      <!-- Form -->
      <form @submit.prevent="regiterUser">
        <!-- Email -->
        <div class="pt-2">
          <label for="name" class="block text-sm font-medium text-gray-700">
            Name
          </label>
          <input
            type="text"
            id="name"
            v-model="form.name"
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
          <span class="text-red-600" v-if="errors.name">
            {{ errors.name[0] }}
          </span>
        </div>
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
          <span class="text-red-600" v-if="errors.email">
            {{ errors.email[0] }}
          </span>
        </div>

        <!-- Password -->
        <div class="pt-2">
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
          <span class="text-red-600" v-if="errors.password">
            {{ errors.password[0] }}
          </span>
        </div>
        <div class="pt-2">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
            Password Confirmation
          </label>
          <input
            type="password"
            id="password_confirmation"
            v-model="form.password_confirmation"
            class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 border-gray-300"
          />
          <span class="text-red-600" v-if="errors.password_confirmation">
            {{ errors.password_confirmation[0] }}
          </span>
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

<script setup lang="ts">
  import { FetchError } from 'ofetch';


  definePageMeta({
    middleware: ['$guest'],
  });

  const form = ref({
    name: '',
    email:'',
    password:'',
    password_confirmation:''
  })

  interface ValidationError{
    [key:string]: string[]
  }

  const errors = ref<ValidationError>({

  })

  const {refreshUser} = useSanctum()

  async function regiterUser(){
    try{
      await useSanctumFetch('/api/register',{
        method:"post",
        body: form.value
      })

      await refreshUser()
  
      return navigateTo('/dashboard')

    }catch(e){
      if(e instanceof FetchError && e.response?.status===422){
        errors.value = e.response._data.errors
      }
    } 
  }


</script>
