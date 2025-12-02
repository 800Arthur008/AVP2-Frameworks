<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';

defineProps({
    stats: Object,
    categories: Array,
    recent_results: Array,
});
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
                            <div v-for="category in categories" :key="category.id" class="relative">
                                <Link
                                    :href="category.on_cooldown ? '#' : `/quiz/${category.id}`"
                                    :class="['group', { 'pointer-events-none': category.on_cooldown }]"
                                >
                                    <div
                                        :class="[
                                            `bg-gradient-to-br ${category.gradient}`,
                                            'p-8 rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all cursor-pointer text-white h-full',
                                            { 'opacity-50': category.on_cooldown }
                                        ]"
                                    >
                                        <div class="text-center">
                                            <div class="text-6xl mb-4 group-hover:scale-125 transition-transform">{{ category.icon }}</div>
                                            <h3 class="text-2xl font-bold text-black">
                                                {{ category.name }}
                                            </h3>
                                        </div>
                                    </div>
                                </Link>
                                <div v-if="category.on_cooldown" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-xl">
                                    <div class="text-center text-white">
                                        <p class="text-lg font-bold">Indisponível</p>
                                        <p>{{ category.next_quiz_time }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Section -->
                        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <Card className="text-center border-purple-200">
                                <div class="text-4xl mb-2">📊</div>
                                <h3 class="text-gray-600 text-sm mb-1">Quizzes Completados</h3>
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">{{ stats.total_quizzes }}</div>
                            </Card>
                            <Card className="text-center border-purple-200">
                                <div class="text-4xl mb-2">⭐</div>
                                <h3 class="text-gray-600 text-sm mb-1">Pontos Totais</h3>
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">{{ stats.total_points }}</div>
                            </Card>
                            <Card className="text-center border-purple-200">
                                <div class="text-4xl mb-2">📈</div>
                                <h3 class="text-gray-600 text-sm mb-1">Média de Pontos</h3>
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">{{ stats.average_score }}%</div>
                            </Card>
                        </div>

                        <!-- Histórico Recente -->
                        <div v-if="recent_results.length > 0" class="mt-12">
                            <h2 class="text-2xl font-bold mb-6 text-gray-900">Histórico Recente</h2>
                            <div class="space-y-3">
                                <div v-for="result in recent_results" :key="result.id" class="bg-white p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ result.category.name }}</p>
                                            <p class="text-sm text-gray-600">{{ result.correct_answers }} acertos de {{ result.total_questions }} perguntas</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">{{ result.score }}%</div>
                                            <p class="text-xs text-gray-500">{{ new Date(result.created_at).toLocaleDateString('pt-BR') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
