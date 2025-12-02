<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';

defineProps({
    user: Object,
    ranking: Array,
});
</script>

<template>
    <Head title="Ranking" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                Ranking
            </h2>
        </template>

        <div class="py-12 bg-white min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="p-6">
                        <h1 class="text-4xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-3">
                            🏆 Ranking Top 10
                        </h1>

                        <p class="text-center text-gray-600 mb-12 text-lg">
                            Veja os melhores jogadores do AVP Quiz!
                        </p>

                        <Card className="max-w-2xl mx-auto border-purple-200">
                            <div class="space-y-4">
                                <div v-for="(player, index) in ranking" :key="player.id"
                                     :class="['flex items-center justify-between p-3 rounded-lg', player.id === user.id ? 'bg-purple-100 border-2 border-purple-400' : 'bg-gray-50']">
                                    <div class="flex items-center gap-4">
                                        <span class="font-bold text-lg text-purple-600">{{ index + 1 }}</span>
                                        <span class="font-semibold text-gray-800">{{ player.name }}</span>
                                    </div>
                                    <span class="font-bold text-lg text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                        {{ player.score }} pts
                                    </span>
                                </div>
                            </div>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
