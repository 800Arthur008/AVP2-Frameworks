<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';

const categories = [
    { id: 1, name: 'História', icon: '📚', gradient: 'from-blue-400 to-blue-600' },
    { id: 2, name: 'Jogos', icon: '🎮', gradient: 'from-purple-400 to-purple-600' },
    { id: 3, name: 'Filmes', icon: '🎬', gradient: 'from-red-400 to-red-600' },
    { id: 4, name: 'Músicas', icon: '🎵', gradient: 'from-pink-400 to-pink-600' },
    { id: 5, name: 'Computação', icon: '💻', gradient: 'from-green-400 to-green-600' },
    { id: 6, name: 'Programação', icon: '⌨️', gradient: 'from-yellow-400 to-yellow-600' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                Dashboard
            </h2>
        </template>

        <div class="py-12 bg-white min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="p-6">
                        <h1 class="text-4xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-3">
                            Bem-vindo ao AVP Quiz! 🎓
                        </h1>
                        
                        <p class="text-center text-gray-600 mb-12 text-lg">
                            Escolha uma categoria e comece a responder quizzes agora
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <Link 
                                v-for="category in categories"
                                :key="category.id"
                                href="/quiz"
                                class="group"
                            >
                                <div
                                    :class="[
                                        `bg-gradient-to-br ${category.gradient}`,
                                        'p-8 rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all cursor-pointer text-white h-full'
                                    ]"
                                >
                                    <div class="text-center">
                                        <div class="text-6xl mb-4 group-hover:scale-125 transition-transform">{{ category.icon }}</div>
                                        <h3 class="text-2xl font-bold">
                                            {{ category.name }}
                                        </h3>
                                    </div>
                                </div>
                            </Link>
                        </div>

                        <!-- Stats Section -->
                        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <Card className="text-center border-purple-200">
                                <div class="text-4xl mb-2">📊</div>
                                <h3 class="text-gray-600 text-sm mb-1">Quizzes Completados</h3>
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">0</div>
                            </Card>
                            <Card className="text-center border-purple-200">
                                <div class="text-4xl mb-2">⭐</div>
                                <h3 class="text-gray-600 text-sm mb-1">Pontuação Total</h3>
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">0 pts</div>
                            </Card>
                            <Card className="text-center border-purple-200">
                                <div class="text-4xl mb-2">🏆</div>
                                <h3 class="text-gray-600 text-sm mb-1">Classificação</h3>
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">#0</div>
                            </Card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
