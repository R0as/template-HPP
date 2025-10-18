<template>
  <div 
    v-if="visible" 
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
  >
    
    <div class="relative w-full max-w-lg rounded-lg bg-white p-8 shadow-xl">
      
      <button 
        @click="emit('close')"
        class="absolute top-4 right-4 cursor-pointer text-2xl text-gray-400 transition-colors hover:text-gray-800"
      >
        &times; </button>
      
      <slot></slot>

    </div>
  </div>
</template>

<script setup lang="ts">
    defineProps<{
    visible: boolean
    }>()

    const emit = defineEmits<{
    (e: 'close'): void
    }>()
</script>

<style lang="scss" scoped>

</style>