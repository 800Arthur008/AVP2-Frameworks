<script setup>
import { Link } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'
</script>

<template>
  <header class="w-full bg-white shadow-md border-b border-purple-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <Link href="/" class="flex items-center gap-3">
          <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold shadow-md">QZ</div>
          <div class="hidden sm:block text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">AVP Quiz</div>
        </Link>
      </div>

      <nav class="flex items-center gap-3">
        <Link href="/" class="text-sm font-medium text-gray-700 hover:text-purple-600 transition">Home</Link>
        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="hidden sm:inline text-sm font-medium text-gray-700 hover:text-purple-600 transition">Dashboard</Link>
        <template v-else>
          <Link v-if="$page.props.canLogin" :href="route('login')" class="hidden sm:inline text-sm font-medium text-gray-700 hover:text-purple-600 transition">Login</Link>
          <Link v-if="$page.props.canRegister" :href="route('register')" class="ml-2 hidden sm:inline"><PrimaryButton>Sign up</PrimaryButton></Link>
        </template>
      </nav>
    </div>
  </header>
</template>

<style scoped>
/* small header style */
</style>
