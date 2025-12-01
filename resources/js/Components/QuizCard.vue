<template>
  <div class="cursor-pointer hover:shadow-2xl hover:scale-105 transition rounded-xl overflow-hidden">
    <Card className="h-full flex flex-col justify-between bg-gradient-to-br from-purple-50 to-pink-50 border-purple-200">
      <div>
        <div class="text-5xl mb-3">{{ quiz.icon }}</div>
        <h3 class="text-lg font-semibold text-gray-900">{{ quiz.title }}</h3>
        <p class="text-sm text-gray-600 mt-2">{{ quiz.description }}</p>
      </div>

      <div class="mt-4 flex items-center justify-between">
        <span :class="['text-sm font-bold px-3 py-1 rounded-full', quiz.difficultyColor, {'bg-green-100': quiz.difficulty === 'Fácil', 'bg-yellow-100': quiz.difficulty === 'Médio', 'bg-red-100': quiz.difficulty === 'Difícil'}]">{{ quiz.difficulty }}</span>
        <span class="text-sm text-gray-500 font-medium">{{ quiz.questions }} perguntas</span>
      </div>
    </Card>
  </div>
</template>

<script setup>
import Card from '@/Components/Card.vue'
import { defineProps } from 'vue'

const props = defineProps({
  quiz: { type: Object, required: true },
})
</script>

<style scoped>
</style>
