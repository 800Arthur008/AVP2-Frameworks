<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
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
const isSaving = ref(false)

const currentQuestion = computed(() => props.questions[currentQuestionIndex.value])
const progress = computed(() => ((currentQuestionIndex.value + 1) / props.questions.length) * 100)
const correctCount = computed(() => {
  let count = 0
  props.questions.forEach((q, index) => {
    if (selectedAnswers.value[index] === q.correct_option) {
      count++
    }
  })
  return count
})
const wrongCount = computed(() => props.questions.length - correctCount.value)
const score = computed(() => Math.round((correctCount.value / props.questions.length) * 100))

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

const saveResult = () => {
    isSaving.value = true
    router.post('/quiz/save-result', {
        category_id: props.category.id,
        total_questions: props.questions.length,
        correct_answers: correctCount.value,
        wrong_answers: wrongCount.value,
        score: score.value,
        user_answers: selectedAnswers.value,
    }, {
        onSuccess: () => {
            setTimeout(() => {
                router.visit('/dashboard')
            }, 1500)
        },
        onError: () => {
            isSaving.value = false
            alert('Erro ao salvar resultado. Tente novamente.')
        },
        onFinish: () => {
            isSaving.value = false
        }
    })
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
          <div class="flex justify-center gap-3">
            <button
              @click="nextQuestion"
              :disabled="selectedAnswers[currentQuestionIndex] === undefined"
              class="w-full px-4 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold hover:shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
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
            <div v-if="score >= 80" class="text-6xl mb-4">🏆</div>
            <div v-else-if="score >= 60" class="text-6xl mb-4">⭐</div>
            <div v-else class="text-6xl mb-4">📚</div>
          </div>

          <h2 class="text-3xl font-bold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
            Quiz Finalizado!
          </h2>

          <div class="mb-8 grid grid-cols-3 gap-4">
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
              <div class="text-2xl font-bold text-green-600">{{ correctCount }}</div>
              <p class="text-sm text-green-700">Acertos</p>
            </div>
            <div class="bg-red-50 p-4 rounded-lg border border-red-200">
              <div class="text-2xl font-bold text-red-600">{{ wrongCount }}</div>
              <p class="text-sm text-red-700">Erros</p>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
              <div class="text-2xl font-bold text-blue-600">{{ score }}%</div>
              <p class="text-sm text-blue-700">Pontuação</p>
            </div>
          </div>

          <!-- Feedback -->
          <div class="mb-8 p-4 rounded-lg bg-blue-50 border border-blue-200">
            <p v-if="score === 100" class="text-blue-900 font-semibold">🎉 Parabéns! Você acertou todas as perguntas!</p>
            <p v-else-if="score >= 80" class="text-blue-900 font-semibold">😊 Excelente resultado! Você é muito bom!</p>
            <p v-else-if="score >= 60" class="text-blue-900 font-semibold">👍 Bom resultado! Continue praticando!</p>
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
          <div class="flex justify-center">
            <button
              @click="saveResult"
              :disabled="isSaving"
              class="w-full px-4 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold hover:shadow-lg transition disabled:opacity-50"
            >
              {{ isSaving ? 'Salvando...' : 'Salvar e Ir para Dashboard' }} ✅
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
