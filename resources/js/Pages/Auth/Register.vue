<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SiteHeader from '@/Components/SiteHeader.vue';
import SiteFooter from '@/Components/SiteFooter.vue';
import Card from '@/Components/Card.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
  <div class="min-h-screen bg-white text-gray-900">
    <SiteHeader />

    <main class="max-w-md mx-auto px-6 py-12">
      <Card>
        <div class="text-center mb-6">
          <div class="text-5xl mb-2">🏆</div>
          <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Criar conta</h1>
          <p class="text-sm text-gray-500 mt-2">Cadastre-se para acompanhar seu progresso e participar dos quizzes</p>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <InputLabel for="name" value="Nome" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full border border-purple-200 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full border border-purple-200 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    v-model="form.email"
                    required
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
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div>
                <InputLabel
                    for="password_confirmation"
                    value="Confirmar senha"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full border border-purple-200 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end gap-3">
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-600 hover:text-purple-600 transition font-medium"
                >
                    Já registrado?
                </Link>

                <PrimaryButton
                    class="bg-gradient-to-r from-purple-500 to-pink-500 hover:shadow-lg transition"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Criar conta
                </PrimaryButton>
            </div>
        </form>
      </Card>
    </main>

    <SiteFooter />
  </div>
</template>
