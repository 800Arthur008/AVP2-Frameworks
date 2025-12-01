<template>
  <div :class="['rounded-xl p-6 bg-white shadow-lg border border-purple-100 hover:shadow-xl transition', className]">
    <slot />
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  className: { type: [String, Array, Object], default: '' },
})
</script>

<style scoped>
</style>
