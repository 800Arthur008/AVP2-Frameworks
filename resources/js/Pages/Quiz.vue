<script setup>
import { Head, Link } from '@inertiajs/vue3'
import SiteHeader from '@/Components/SiteHeader.vue'
import SiteFooter from '@/Components/SiteFooter.vue'
</script>

<template>
  <Head title="Quiz" />
  <div class="min-h-screen bg-white text-gray-900">
    <SiteHeader />

    <main class="max-w-4xl mx-auto px-6 py-12">
      <Card className="border-purple-200">
        <div class="text-center mb-6">
          <div class="text-5xl mb-3">❓</div>
          <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Quiz de exemplo</h1>
        </div>
        <p class="text-sm text-gray-600 mb-6 text-center">Esta é uma página inicial de quiz — aqui você pode implementar o fluxo de perguntas.</p>
        <div class="space-y-4">
          <div class="p-4 rounded-lg border-2 border-purple-200 bg-purple-50 hover:bg-purple-100 transition cursor-pointer">
            <div class="font-semibold text-purple-900">Pergunta 1</div>
            <div class="text-sm text-purple-700 mt-1">Exemplo de pergunta para o quiz</div>
          </div>
          <div class="p-4 rounded-lg border-2 border-pink-200 bg-pink-50 hover:bg-pink-100 transition cursor-pointer">
            <div class="font-semibold text-pink-900">Pergunta 2</div>
            <div class="text-sm text-pink-700 mt-1">Exemplo de pergunta para o quiz</div>
          </div>
        </div>
      </Card>
    </main>

    <SiteFooter />
  </div>
</template>

<style scoped>
</style>
