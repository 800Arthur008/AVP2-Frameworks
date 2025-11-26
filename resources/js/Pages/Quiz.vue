<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    category: Object,
    questions: Array,
});

const categoryTitles = {
    1: 'História',
    2: 'Jogos',
    3: 'Filmes',
    4: 'Geografia',
    5: 'Computação',
    6: 'Programação'
};

const currentQuestion = ref(0);
const userAnswers = ref([]);
const quizFinished = ref(false);
const quizQuestions = props.questions;

const selectAnswer = (optionIndex) => {
    userAnswers.value[currentQuestion.value] = optionIndex;
    
    if (currentQuestion.value < quizQuestions.length - 1) {
        currentQuestion.value++;
    } else {
        quizFinished.value = true;
    }
};

const calculateResults = () => {
    let correct = 0;
    userAnswers.value.forEach((answer, index) => {
        if (answer === quizQuestions[index].correct_option) {
            correct++;
        }
    });
    return {
        correct,
        total: quizQuestions.length,
        percentage: Math.round((correct / quizQuestions.length) * 100)
    };
};

const getResultMessage = (percentage) => {
    if (percentage === 100) return 'Perfeito! Você é um especialista! 🏆';
    if (percentage >= 80) return 'Excelente! Você sabe muito sobre isso! 🌟';
    if (percentage >= 60) return 'Muito bem! Você tem bom conhecimento! 👏';
    if (percentage >= 40) return 'Bom esforço! Continue estudando! 📚';
    return 'Tente novamente! Você consegue! 💪';
};
</script>

<template>
    <Head :title="`${props.category.name} - Quiz`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Quiz - {{ props.category.name }}
            </h2>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <!-- Quiz em andamento -->
                <div v-if="!quizFinished" class="space-y-6">
                    <!-- Barra de progresso -->
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <div class="flex justify-between mb-3">
                            <span class="text-sm font-semibold text-gray-700">
                                Pergunta {{ currentQuestion + 1 }} de {{ quizQuestions.length }}
                            </span>
                            <span class="text-sm font-semibold text-gray-700">
                                {{ Math.round(((currentQuestion + 1) / quizQuestions.length) * 100) }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div
                                class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-300"
                                :style="{ width: `${((currentQuestion + 1) / quizQuestions.length) * 100}%` }"
                            ></div>
                        </div>
                    </div>

                    <!-- Card principal -->
                    <div class="bg-white shadow-lg rounded-lg p-8">
                        <!-- Pergunta -->
                        <div class="mb-10">
                            <h2 class="text-3xl font-bold text-gray-800 text-center">
                                {{ quizQuestions[currentQuestion].question }}
                            </h2>
                        </div>

                        <!-- Opções -->
                        <div class="space-y-4">
                            <button
                                v-for="(option, index) in quizQuestions[currentQuestion].options"
                                :key="index"
                                @click="selectAnswer(index)"
                                class="w-full flex items-center gap-4 p-4 text-left border-2 rounded-lg transition-all duration-200 hover:border-blue-500 hover:bg-blue-50"
                                :class="{
                                    'border-blue-500 bg-blue-50': userAnswers[currentQuestion] === index,
                                    'border-gray-300 bg-white': userAnswers[currentQuestion] !== index
                                }"
                            >
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500 text-white font-bold text-lg flex-shrink-0">
                                    {{ String.fromCharCode(65 + index) }}
                                </div>
                                <span class="font-semibold text-gray-800">
                                    {{ option }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tela de resultados -->
                <div v-else class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 px-8 py-20 text-center text-black">
                        <div class="mb-6 text-8xl">
                            {{ calculateResults().percentage >= 60 ? '🎉' : '📝' }}
                        </div>
                        <h2 class="mb-4 text-4xl font-bold">
                            Quiz Finalizado!
                        </h2>
                        <p class="text-xl opacity-90">
                            {{ getResultMessage(calculateResults().percentage) }}
                        </p>
                    </div>

                    <div class="p-8">
                        <!-- Resultado em números -->
                        <div class="mb-12 grid grid-cols-3 gap-6">
                            <div class="rounded-lg border-2 border-green-200 bg-green-50 p-6 text-center">
                                <p class="mb-3 text-sm font-semibold text-gray-600">Acertos</p>
                                <p class="text-5xl font-bold text-green-500">
                                    {{ calculateResults().correct }}
                                </p>
                            </div>
                            <div class="rounded-lg border-2 border-red-200 bg-red-50 p-6 text-center">
                                <p class="mb-3 text-sm font-semibold text-gray-600">Erros</p>
                                <p class="text-5xl font-bold text-red-500">
                                    {{ calculateResults().total - calculateResults().correct }}
                                </p>
                            </div>
                            <div class="rounded-lg border-2 border-blue-200 bg-blue-50 p-6 text-center">
                                <p class="mb-3 text-sm font-semibold text-gray-600">Pontuação</p>
                                <p class="text-5xl font-bold text-blue-500">
                                    {{ calculateResults().percentage }}%
                                </p>
                            </div>
                        </div>

                        <!-- Botão voltar -->
                        <div class="flex justify-center">
                            <Link
                                href="/dashboard"
                                class="inline-block rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 px-12 py-4 font-semibold text-black transition-all duration-300 hover:shadow-lg hover:scale-105"
                            >
                                Voltar às Categorias
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>