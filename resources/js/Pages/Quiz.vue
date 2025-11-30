<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import SiteHeader from '@/Components/SiteHeader.vue'
import SiteFooter from '@/Components/SiteFooter.vue'
import Card from '@/Components/Card.vue'

const props = defineProps({
    category: Object,
    questions: Array,
})

const currentQuestionIndex = ref(0)
const selectedAnswers = ref({})
const quizFinished = ref(false)

const currentQuestion = computed(() => props.questions[currentQuestionIndex.value])
const progress = computed(() => ((currentQuestionIndex.value + 1) / props.questions.length) * 100)
const score = computed(() => {
  let correctCount = 0
  props.questions.forEach((q, index) => {
    if (selectedAnswers.value[index] === q.correct_option) {
      correctCount++
    }
  })
  return correctCount
})

const selectAnswer = (optionIndex) => {
    selectedAnswers.value[currentQuestionIndex.value] = optionIndex
}

const nextQuestion = () => {
    if (currentQuestionIndex.value < props.questions.length - 1) {
        currentQuestionIndex.value++
    } else {
        quizFinished.value = true
    }
}

const previousQuestion = () => {
    if (currentQuestionIndex.value > 0) {
        currentQuestionIndex.value--
    }
}

const restartQuiz = () => {
    currentQuestionIndex.value = 0
    selectedAnswers.value = {}
    quizFinished.value = false
}
</script>

<template>
  <Head :title="`${category.name} - Quiz`" />
  <div class="min-h-screen bg-white text-gray-900">
    <SiteHeader />

    <main class="max-w-2xl mx-auto px-6 py-12">
      <!-- Quiz Em Progresso -->
      <div v-if="!quizFinished">
        <Card className="border-purple-200">
          <!-- Header -->
          <div class="mb-6">
            <div class="flex justify-between items-center mb-4">
              <span class="text-sm font-semibold text-purple-600">Pergunta {{ currentQuestionIndex + 1 }} de {{ questions.length }}</span>
              <span class="text-sm font-semibold text-gray-600">{{ Math.round(progress) }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
              <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full transition-all" :style="{ width: progress + '%' }"></div>
            </div>
          </div>

          <!-- Categoria -->
          <div class="mb-4">
            <span class="inline-block bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">{{ category.name }}</span>
          </div>

          <!-- Pergunta -->
          <h2 class="text-2xl font-bold mb-6 text-gray-900">{{ currentQuestion.question }}</h2>

          <!-- Opções -->
          <div class="space-y-3 mb-8">
            <button
              v-for="(option, index) in currentQuestion.options"
              :key="index"
              @click="selectAnswer(index)"
              :class="[
                'w-full p-4 rounded-lg border-2 text-left font-medium transition-all',
                selectedAnswers[currentQuestionIndex] === index
                  ? 'border-purple-500 bg-purple-50 text-purple-900'
                  : 'border-gray-200 bg-gray-50 text-gray-900 hover:border-purple-300'
              ]"
            >
              <span class="flex items-center gap-3">
                <span :class="[
                  'w-6 h-6 rounded-full border-2 flex items-center justify-center',
                  selectedAnswers[currentQuestionIndex] === index
                    ? 'border-purple-500 bg-purple-500 text-white'
                    : 'border-gray-300'
                ]">
                  <span v-if="selectedAnswers[currentQuestionIndex] === index" class="text-sm">✓</span>
                </span>
                {{ option }}
              </span>
            </button>
          </div>

          <!-- Botões de Navegação -->
          <div class="flex gap-3">
            <button
              @click="previousQuestion"
              :disabled="currentQuestionIndex === 0"
              class="flex-1 px-4 py-2 rounded-lg border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition"
            >
              ← Anterior
            </button>
            <button
              @click="nextQuestion"
              class="flex-1 px-4 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold hover:shadow-lg transition"
            >
              {{ currentQuestionIndex === questions.length - 1 ? 'Finalizar' : 'Próxima' }} →
            </button>
          </div>
        </Card>
      </div>

      <!-- Resultado Final -->
      <div v-else>
        <Card className="border-purple-200 text-center">
          <div class="mb-6">
            <div v-if="score >= questions.length * 0.8" class="text-6xl mb-4">🏆</div>
            <div v-else-if="score >= questions.length * 0.6" class="text-6xl mb-4">⭐</div>
            <div v-else class="text-6xl mb-4">📚</div>
          </div>

          <h2 class="text-3xl font-bold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
            Quiz Finalizado!
          </h2>

          <div class="mb-8">
            <p class="text-gray-600 mb-4">Sua pontuação:</p>
            <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
              {{ score }} / {{ questions.length }}
            </div>
            <p class="text-lg text-gray-600 mt-2">
              {{ Math.round((score / questions.length) * 100) }}%
            </p>
          </div>

          <!-- Feedback -->
          <div class="mb-8 p-4 rounded-lg bg-blue-50 border border-blue-200">
            <p v-if="score === questions.length" class="text-blue-900 font-semibold">🎉 Parabéns! Você acertou todas as perguntas!</p>
            <p v-else-if="score >= questions.length * 0.8" class="text-blue-900 font-semibold">😊 Excelente resultado! Você é muito bom!</p>
            <p v-else-if="score >= questions.length * 0.6" class="text-blue-900 font-semibold">👍 Bom resultado! Continue praticando!</p>
            <p v-else class="text-blue-900 font-semibold">💪 Que tal tentar novamente? Você consegue melhorar!</p>
          </div>

          <!-- Detalhes das Respostas -->
          <div class="mb-8 text-left max-h-64 overflow-y-auto">
            <h3 class="font-bold mb-4 text-lg">Resumo das Respostas:</h3>
            <div v-for="(q, idx) in questions" :key="idx" class="mb-4 p-3 rounded-lg bg-gray-50 border border-gray-200">
              <p class="font-semibold text-gray-900 mb-2">{{ q.question }}</p>
              <p class="text-sm mb-2">
                <span class="font-medium">Sua resposta:</span>
                <span :class="selectedAnswers[idx] === q.correct_option ? 'text-green-600' : 'text-red-600'">
                  {{ q.options[selectedAnswers[idx]] || 'Não respondida' }}
                </span>
              </p>
              <p v-if="selectedAnswers[idx] !== q.correct_option" class="text-sm">
                <span class="font-medium">Resposta correta:</span>
                <span class="text-green-600">{{ q.options[q.correct_option] }}</span>
              </p>
            </div>
          </div>

          <!-- Botões Finais -->
          <div class="flex gap-3">
            <Link href="/dashboard" class="flex-1">
              <button class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                ← Voltar para Dashboard
              </button>
            </Link>
            <button
              @click="restartQuiz"
              class="flex-1 px-4 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold hover:shadow-lg transition"
            >
              Refazer Quiz 🔄
            </button>
          </div>
        </Card>
      </div>
    </main>

    <SiteFooter />
  </div>
</template>

<style scoped>
</style>
