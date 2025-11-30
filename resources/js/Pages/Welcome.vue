<script setup>
import { Head, Link } from '@inertiajs/vue3'
import SiteHeader from '@/Components/SiteHeader.vue'
import SiteFooter from '@/Components/SiteFooter.vue'
import QuizCard from '@/Components/QuizCard.vue'

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
})

const quizzes = [
  { id: 1, title: 'Conhecimentos Gerais', description: 'Perguntas variadas para desafiar você.', difficulty: 'Fácil', difficultyColor: 'text-green-600', icon: '🧠', questions: 10 },
  { id: 2, title: 'Programação', description: 'Algoritmos, lógica e linguagens.', difficulty: 'Médio', difficultyColor: 'text-yellow-600', icon: '💻', questions: 12 },
  { id: 3, title: 'História', description: 'Datas, eventos e personagens.', difficulty: 'Médio', difficultyColor: 'text-yellow-600', icon: '📜', questions: 15 },
  { id: 4, title: 'Ciências', description: 'Física, química e biologia.', difficulty: 'Difícil', difficultyColor: 'text-red-600', icon: '🔬', questions: 20 },
]
</script>

<template>
  <Head title="AVP Quiz" />
  <div class="min-h-screen bg-white text-gray-900">
    <SiteHeader />

    <main class="max-w-7xl mx-auto px-6 py-16">
      <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <div>
          <h1 class="text-4xl sm:text-5xl font-extrabold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Teste seus conhecimentos — divirta-se aprendendo</h1>
          <p class="text-gray-600 mb-6">Plataforma de quizzes com diversos temas e níveis. Faça quizzes rápidos, acompanhe seu progresso e desafie seus amigos.</p>
          <div class="flex gap-3 flex-wrap">
            <Link v-if="$page.props.canRegister" href="/register" class="inline-block">
              <button class="inline-flex items-center gap-2 border-2 border-purple-300 bg-purple-50 text-purple-600 px-4 py-3 rounded-lg hover:bg-purple-100 transition">
                <span>✍️</span> Criar conta
              </button>
            </Link>
          </div>
        </div>

        <div class="hidden lg:block">
          <div class="rounded-2xl overflow-hidden shadow-lg bg-gradient-to-br from-purple-50 to-pink-50 p-8 flex items-center justify-center h-72">
            <div class="text-center">
              <div class="text-7xl mb-4">🎯</div>
              <p class="text-lg font-semibold text-purple-900">Começe sua jornada</p>
              <p class="text-gray-600">Teste seus conhecimentos agora</p>
            </div>
          </div>
        </div>
      </section>

      <section class="mt-12">
        <h2 class="text-2xl font-semibold mb-6">Quizzes populares</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <QuizCard v-for="q in quizzes" :key="q.id" :quiz="q" />
        </div>
      </section>

      <section class="mt-12 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white rounded-2xl p-8 shadow-xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
          <div>
            <h3 class="text-xl font-bold">Quer testar seus conhecimentos todos os dias?</h3>
            <p class="text-sm opacity-90">Cadastre-se e acompanhe seu progresso com estatísticas e recomendações.</p>
          </div>
          <div>
            <Link v-if="$page.props.canRegister" href="/register"><button class="inline-flex items-center gap-2 bg-white text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 px-5 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl"><span>✨</span> Cadastre-se gratuitamente</button></Link>
          </div>
        </div>
      </section>
    </main>

    <SiteFooter />
  </div>
</template>

<style scoped>
/* You can add small landing-specific styles here */
</style>

