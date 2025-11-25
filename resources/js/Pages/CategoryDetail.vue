<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    category: Object,
});

const categoryDescriptions = {
    1: {
        title: 'História',
        description: 'Mergulhe no fascinante mundo da história! Teste seus conhecimentos sobre grandes civilizações, eventos marcantes e personagens históricos que moldaram nosso mundo. Desde a antiguidade até os dias atuais, explore os momentos que definiram a humanidade.',
        icon: '📚'
    },
    2: {
        title: 'Jogos',
        description: 'Apaixonado por jogos? Esta é sua categoria! Desafie-se com perguntas sobre videogames clássicos e modernos, desenvolvedoras famosas, personagens icônicos e curiosidades do universo gamer. Mostre que você é um verdadeiro gaming master!',
        icon: '🎮'
    },
    3: {
        title: 'Filmes',
        description: 'Que tal testar seu conhecimento sobre o sétimo art? Responda perguntas sobre filmes de todos os gêneros, diretores renomados, atores memoráveis e cenas icônicas do cinema. Desde blockbusters até clássicos, mostre que você é um verdadeiro cinéfilo!',
        icon: '🎬'
    },
    4: {
        title: 'Geografia',
        description: 'Explore o planeta com nosso quiz de geografia! Teste seus conhecimentos sobre países, capitais, continentes, rios, montanhas e curiosidades geográficas fascinantes. Descubra novos lugares e expanda seus horizontes!',
        icon: '🌎'
    },
    5: {
        title: 'Computação',
        description: 'Você é um entusiasta de tecnologia? Desafie-se nesta categoria sobre computação! Perguntas sobre hardware, software, história da computação, termos técnicos e inovações tecnológicas que mudaram o mundo.',
        icon: '💻'
    },
    6: {
        title: 'Programação',
        description: 'Para os amantes de código! Teste seus conhecimentos sobre linguagens de programação, algoritmos, padrões de design, frameworks e best practices. Mostre seu domínio do desenvolvimento de software!',
        icon: '⌨️'
    },
};
</script>

<template>
    <Head :title="`${categoryDescriptions[category.id].title} - FapQuiz`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ categoryDescriptions[category.id].title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900">
                        <div class="text-center mb-8">
                            <div class="text-7xl mb-4">
                                {{ categoryDescriptions[category.id].icon }}
                            </div>
                            <h1 class="text-4xl font-bold text-gray-800">
                                {{ categoryDescriptions[category.id].title }}
                            </h1>
                        </div>

                        <div class="mb-8">
                            <p class="text-lg text-gray-700 leading-relaxed mb-6">
                                {{ categoryDescriptions[category.id].description }}
                            </p>
                        </div>

                        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8">
                            <p class="text-gray-700">
                                <span class="font-semibold">Pronto para o desafio?</span> Teste seus conhecimentos e veja como se sai nesta categoria!
                            </p>
                        </div>

                        <div class="flex gap-4 justify-center">
                            <Link
                                :href="`/quiz/${category.id}`"
                                class="px-15 py-5 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors"
                            >
                                Iniciar Quiz
                            </Link>
                            <Link
                                href="/dashboard"
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