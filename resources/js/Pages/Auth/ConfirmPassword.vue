<script setup>
import SiteHeader from '@/Components/SiteHeader.vue';
import SiteFooter from '@/Components/SiteFooter.vue';
import Card from '@/Components/Card.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Confirmar Senha" />
    <div class="min-h-screen bg-white text-gray-900">
        <SiteHeader />

        <main class="max-w-md mx-auto px-6 py-12">
            <Card className="border-purple-200">
                <div class="text-center mb-6">
                    <div class="text-5xl mb-3">🔒</div>
                    <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Confirmar Senha</h1>
                </div>

                <div class="mb-6 text-sm text-gray-600 text-center">
                    Esta é uma área segura da aplicação. Por favor, confirme sua senha para continuar.
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <InputLabel for="password" value="Senha" />
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-2 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-6">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-2 px-4 rounded-lg hover:shadow-lg transition disabled:opacity-50"
                        >
                            {{ form.processing ? 'Confirmando...' : 'Confirmar' }}
                        </button>
                    </div>
                </form>
            </Card>
        </main>

        <SiteFooter />
    </div>
</template>
