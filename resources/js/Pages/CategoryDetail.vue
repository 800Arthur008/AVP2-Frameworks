<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
});

const description = computed(() =>
    props.category.description
        ? props.category.description
        : `Teste seus conhecimentos na categoria ${props.category.name}! Cada rodada traz perguntas diferentes para você praticar.`,
);
</script>

<template>
    <Head :title="`${category.name} - FapQuiz`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center gap-3">
                <span class="text-3xl">{{ category.icon }}</span>
                {{ category.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900 space-y-8">
                        <div class="text-center mb-8">
                            <div class="text-7xl mb-4">
                                {{ category.icon }}
                            </div>
                            <h1 class="text-4xl font-bold text-gray-800">
                                {{ category.name }}
                            </h1>
                            <p class="text-sm text-gray-500 mt-2">
                                {{ category.questions_count }} {{ category.questions_count === 1 ? 'pergunta disponível' : 'perguntas disponíveis' }}
                            </p>
                        </div>

                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ description }}
                        </p>

                        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8">
                            <p class="text-gray-700">
                                <span class="font-semibold">{{ category.name }}</span> está pronto para testar seus conhecimentos.
                                Responda às perguntas e acompanhe seu progresso!
                            </p>
                        </div>

                        <div class="flex gap-4 justify-center">
                            <Link
                                :href="route('quiz.show', category.id)"
                                class="px-15 py-5 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors"
                            >
                                Iniciar Quiz
                            </Link>
                            <Link
                                :href="route('dashboard')"
                                class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-colors"
                            >
                                Voltar
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>