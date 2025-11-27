<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const page = usePage();

const flashMessage = computed(() => page.props.flash?.message);

const categoryForm = useForm({
    name: '',
    icon: '',
});

const questionForm = useForm({
    category_id: '',
    question: '',
    options: ['', '', '', ''],
    correct_option: 0,
});

const submitCategory = () => {
    categoryForm.post(route('admin.categories.store'), {
        preserveScroll: true,
        onSuccess: () => categoryForm.reset(),
    });
};

const submitQuestion = () => {
    questionForm.post(route('admin.questions.store'), {
        preserveScroll: true,
        onSuccess: () => {
            questionForm.reset();
            questionForm.options = ['', '', '', ''];
            questionForm.correct_option = 0;
        },
    });
};

const addOption = () => {
    if (questionForm.options.length >= 6) return;
    questionForm.options.push('');
};

const removeOption = (index) => {
    if (questionForm.options.length <= 2) return;
    questionForm.options.splice(index, 1);
    if (questionForm.correct_option >= questionForm.options.length) {
        questionForm.correct_option = 0;
    }
};
</script>

<template>
    <Head title="Administração" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Painel administrativo
                </h2>
                <span class="text-sm text-gray-500">
                    Gere novas categorias e perguntas
                </span>
            </div>
        </template>

        <div class="py-12 bg-gray-100 min-h-screen">
            <div class="mx-auto max-w-7xl space-y-8 sm:px-6 lg:px-8">
                <div v-if="flashMessage" class="rounded-md bg-green-50 border border-green-200 p-4 text-green-800">
                    {{ flashMessage }}
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="bg-white shadow rounded-xl p-6 space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Nova categoria
                        </h3>

                        <form @submit.prevent="submitCategory" class="space-y-4">
                            <div>
                                <InputLabel for="name" value="Nome" />
                                <TextInput
                                    id="name"
                                    v-model="categoryForm.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="ex: Ciência"
                                    required
                                />
                                <InputError :message="categoryForm.errors.name" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="icon" value="Ícone/emoji" />
                                <TextInput
                                    id="icon"
                                    v-model="categoryForm.icon"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="ex: 🔬"
                                    required
                                />
                                <InputError :message="categoryForm.errors.icon" class="mt-2" />
                            </div>

                            <PrimaryButton :disabled="categoryForm.processing">
                                Salvar categoria
                            </PrimaryButton>
                        </form>
                    </div>

                    <div class="bg-white shadow rounded-xl p-6 space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Nova pergunta
                        </h3>

                        <form @submit.prevent="submitQuestion" class="space-y-4">
                            <div>
                                <InputLabel for="category" value="Categoria" />
                                <select
                                    id="category"
                                    v-model="questionForm.category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    <option disabled value="">
                                        Selecione uma categoria
                                    </option>
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.icon }} {{ category.name }}
                                    </option>
                                </select>
                                <InputError :message="questionForm.errors.category_id" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="question" value="Pergunta" />
                                <textarea
                                    id="question"
                                    v-model="questionForm.question"
                                    rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Escreva a pergunta aqui..."
                                    required
                                ></textarea>
                                <InputError :message="questionForm.errors.question" class="mt-2" />
                            </div>

                            <div class="space-y-3">
                                <InputLabel value="Opções de resposta" />

                                <div
                                    v-for="(option, index) in questionForm.options"
                                    :key="index"
                                    class="flex items-start gap-3"
                                >
                                    <TextInput
                                        :id="`option-${index}`"
                                        v-model="questionForm.options[index]"
                                        type="text"
                                        class="mt-1 block w-full"
                                        :placeholder="`Opção ${index + 1}`"
                                        required
                                    />

                                    <button
                                        type="button"
                                        class="text-xs text-red-500 hover:text-red-700 mt-2"
                                        @click="removeOption(index)"
                                        v-if="questionForm.options.length > 2"
                                    >
                                        Remover
                                    </button>
                                </div>

                                <SecondaryButton
                                    type="button"
                                    class="text-sm"
                                    @click="addOption"
                                    :disabled="questionForm.options.length >= 6"
                                >
                                    Adicionar opção
                                </SecondaryButton>
                                <InputError :message="questionForm.errors.options" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="correct" value="Resposta correta" />
                                <select
                                    id="correct"
                                    v-model.number="questionForm.correct_option"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    <option
                                        v-for="(option, index) in questionForm.options"
                                        :key="`correct-${index}`"
                                        :value="index"
                                    >
                                        {{ index + 1 }}ª opção
                                    </option>
                                </select>
                                <InputError :message="questionForm.errors.correct_option" class="mt-2" />
                            </div>

                            <PrimaryButton :disabled="questionForm.processing">
                                Salvar pergunta
                            </PrimaryButton>
                        </form>
                    </div>
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Categorias cadastradas
                    </h3>

                    <div v-if="!categories.length" class="text-gray-500">
                        Nenhuma categoria cadastrada ainda.
                    </div>

                    <div
                        v-else
                        class="grid grid-cols-1 gap-6 md:grid-cols-2"
                    >
                        <div
                            v-for="category in categories"
                            :key="category.id"
                            class="rounded-lg border border-gray-200 p-4"
                        >
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-3xl">
                                    {{ category.icon }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ category.questions.length }} perguntas
                                </div>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">
                                {{ category.name }}
                            </h4>

                            <ul class="space-y-2 max-h-40 overflow-y-auto pr-2">
                                <li
                                    v-for="question in category.questions"
                                    :key="question.id"
                                    class="text-sm text-gray-600"
                                >
                                    • {{ question.question }}
                                </li>
                                <li
                                    v-if="!category.questions.length"
                                    class="text-sm text-gray-400 italic"
                                >
                                    Nenhuma pergunta ainda.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

