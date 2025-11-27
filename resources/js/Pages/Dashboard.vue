<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Rank from '../../images/rank.png';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const palette = [
    'bg-blue-500',
    'bg-purple-500',
    'bg-red-500',
    'bg-orange-500',
    'bg-green-500',
    'bg-yellow-500',
    'bg-pink-500',
    'bg-indigo-500',
];

const categoriesWithColor = computed(() =>
    props.categories.map((category, index) => ({
        ...category,
        color: palette[index % palette.length],
    })),
);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="text-3xl text-center font-bold mb-12">
                            Bem Vindo ao FapQuiz!
                        </h1>
                        
                        <p class="text-center text-gray-600 mb-8 font-bold text-2xl">
                            Escolha uma categoria para começar
                        </p>

                        <div v-if="categoriesWithColor.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <Link
                                v-for="category in categoriesWithColor"
                                :key="category.id"
                                :href="route('category.show', category.id)"
                                :class="[
                                    category.color,
                                    'p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow cursor-pointer text-white no-underline relative'
                                ]"
                            >
                                <div class="text-center">
                                    <div class="text-5xl mb-4">{{ category.icon }}</div>
                                    <h3 class="text-2xl font-semibold">
                                        {{ category.name }}
                                    </h3>
                                    <p class="text-sm mt-2 opacity-80">
                                        {{ category.questions_count }} {{ category.questions_count === 1 ? 'pergunta' : 'perguntas' }}
                                    </p>
                                </div>
                            </Link>
                        </div>

                        <div v-else class="text-center text-gray-500">
                            Ainda não há categorias disponíveis. Fale com um administrador.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="text-3xl text-center font-bold mb-12">
                            O que é o FapQuiz?
                        </h1>
                        
                        <p>O Fap Quiz é uma plataforma criada para estimular o conhecimento de forma simples e muito divertida! Aqui, você vai testar seus conhecimentos sobre os mais diversos assuntos de forma divertida e gameficada! Pronto para começar?</p>

                        <img :src="Rank" alt="rank">
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>