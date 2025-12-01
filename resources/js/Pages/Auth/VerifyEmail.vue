<script setup>
import { computed } from 'vue';
import SiteHeader from '@/Components/SiteHeader.vue';
import SiteFooter from '@/Components/SiteFooter.vue';
import Card from '@/Components/Card.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <Head title="Verificar Email" />
    <div class="min-h-screen bg-white text-gray-900">
        <SiteHeader />

        <main class="max-w-md mx-auto px-6 py-12">
            <Card className="border-purple-200">
                <div class="text-center mb-6">
                    <div class="text-5xl mb-3">✉️</div>
                    <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Verificar Email</h1>
                </div>

                <div class="mb-6 text-sm text-gray-600 text-center">
                    Obrigado por se cadastrar! Antes de começar, poderia verificar seu endereço de email clicando no link que acabamos de enviar? Se não recebeu o email, ficaremos felizes em enviar outro.
                </div>

                <div
                    v-if="verificationLinkSent"
                    class="mb-6 p-3 rounded-lg bg-green-50 border border-green-200 text-sm font-medium text-green-700 text-center"
                >
                    Um novo link de verificação foi enviado para o endereço de email fornecido durante o registro.
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-2 px-4 rounded-lg hover:shadow-lg transition disabled:opacity-50"
                    >
                        {{ form.processing ? 'Enviando...' : 'Reenviar Email de Verificação' }}
                    </button>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="w-full border-2 border-purple-300 text-purple-600 font-semibold py-2 px-4 rounded-lg hover:bg-purple-50 transition"
                    >
                        Sair
                    </Link>
                </form>
            </Card>
        </main>

        <SiteFooter />
    </div>
</template>
