<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const categories = [
    { id: 1, name: 'História', icon: '📚', color: 'bg-blue-500' },
    { id: 2, name: 'Jogos', icon: '🎮', color: 'bg-purple-500' },
    { id: 3, name: 'Filmes', icon: '🎬', color: 'bg-red-500' },
    { id: 4, name: 'Músicas', icon: '🎵', color: 'bg-pink-500' },
    { id: 5, name: 'Computação', icon: '💻', color: 'bg-green-500' },
    { id: 6, name: 'Programação', icon: '⌨️', color: 'bg-yellow-500' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="text-3xl text-center font-bold mb-12">
                            Bem Vindo ao FapQuiz!
                        </h1>
                        
                        <p class="text-center text-gray-600 mb-8">
                            Escolha uma categoria para começar
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div
                                v-for="category in categories"
                                :key="category.id"
                                :class="[
                                    category.color,
                                    'p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow cursor-pointer text-white'
                                ]"
                            >
                                <div class="text-center">
                                    <div class="text-5xl mb-4">{{ category.icon }}</div>
                                    <h3 class="text-2xl font-semibold">
                                        {{ category.name }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>