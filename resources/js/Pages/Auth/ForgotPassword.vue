<script setup>
import SiteHeader from '@/Components/SiteHeader.vue';
import SiteFooter from '@/Components/SiteFooter.vue';
import Card from '@/Components/Card.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Esqueci minha senha" />
    <div class="min-h-screen bg-white text-gray-900">
        <SiteHeader />

        <main class="max-w-md mx-auto px-6 py-12">
            <Card className="border-purple-200">
                <div class="text-center mb-6">
                    <div class="text-5xl mb-3">🔑</div>
                    <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Recuperar Senha</h1>
                </div>

                <div class="mb-6 text-sm text-gray-600 text-center">
                    Esqueceu sua senha? Sem problema! Informe seu email e enviaremos um link para você redefinir sua senha.
                </div>

                <div
                    v-if="status"
                    class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm font-medium text-green-700"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-2 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-6">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-2 px-4 rounded-lg hover:shadow-lg transition disabled:opacity-50"
                        >
                            {{ form.processing ? 'Enviando...' : 'Enviar Link de Recuperação' }}
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <Link href="/login" class="text-purple-600 hover:text-pink-600 text-sm font-semibold">
                            Voltar para login
                        </Link>
                    </div>
                </form>
            </Card>
        </main>

        <SiteFooter />
    </div>
</template>
