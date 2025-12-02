<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SiteHeader from '@/Components/SiteHeader.vue';
import SiteFooter from '@/Components/SiteFooter.vue';
import Card from '@/Components/Card.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
  <div class="min-h-screen bg-white text-gray-900">
    <SiteHeader />

    <main class="max-w-md mx-auto px-6 py-12">
      <Card>
        <div class="text-center mb-6">
          <div class="text-5xl mb-2">🧠</div>
          <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 text-center">Entrar</h1>
          <p class="text-sm text-gray-500 mt-2">Acesse sua conta e comece a responder quizzes</p>
        </div>

        <div v-if="status" class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm font-medium text-green-700">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full border border-purple-200 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" value="Senha" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full border border-purple-200 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="text-sm text-gray-600">Lembrar-me</span>
                </label>

                <div>
                  <Link
                      v-if="canResetPassword"
                      :href="route('password.request')"
                      class="text-sm text-purple-600 hover:text-pink-600 transition font-medium"
                  >
                      Esqueceu a senha?
                  </Link>
                </div>
            </div>

            <div>
                <PrimaryButton
                    class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:shadow-lg transition"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Entrar
                </PrimaryButton>
            </div>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
          <span>Não tem conta?</span>
          <Link href="/register" class="text-purple-600 hover:text-pink-600 transition font-semibold ms-2">Cadastre-se</Link>
        </div>
      </Card>
    </main>

    <SiteFooter />
  </div>
</template>
