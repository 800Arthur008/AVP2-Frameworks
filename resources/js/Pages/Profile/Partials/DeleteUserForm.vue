<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                Deletar Conta
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Depois que sua conta for deletada, todos os seus recursos e dados serão permanentemente excluídos. Antes de deletar sua conta, por favor, baixe quaisquer dados ou informações que deseje reter.
            </p>
        </header>

        <button @click="confirmUserDeletion" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
            Deletar Conta
        </button>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900"
                >
                    Tem certeza de que deseja deletar sua conta?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Depois que sua conta for deletada, todos os seus recursos e dados serão permanentemente excluídos. Por favor, digite sua senha para confirmar que gostaria de deletar permanentemente sua conta.
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="Senha"
                        class="sr-only"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4 border border-purple-200 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                        placeholder="Senha"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button @click="closeModal" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </button>

                    <button
                        @click="deleteUser"
                        :disabled="form.processing"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition disabled:opacity-50"
                    >
                        {{ form.processing ? 'Deletando...' : 'Deletar Conta' }}
                    </button>
                </div>
            </div>
        </Modal>
    </section>
</template>
