<template>
  <div class="flex flex-col h-screen">
    <div class="flex flex-1 overflow-hidden">
      <SideBar />
      <div class="flex-1 overflow-y-auto bg-gray-100 p-6">
        <slot/>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
  import SideBar from '~/components/SideBar.vue';
  interface User{
    name:string;
    email:string;
  }

  const{ isLoggedIn , user, logout} =  useSanctum<User>()

  function logoutUser(){
    logout()
  }

</script>