<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Создать промокод</h1>
        <form @submit.prevent="submitForm" class="space-y-4" method="post" action="/promos">
            <div>
                <label for="code" class="block font-medium">Код</label>
                <input
                    type="text"
                    id="code"
                    v-model="form.code"
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div>
                <label for="type" class="block font-medium">Тип</label>
                <select
                    id="type"
                    v-model="form.type"
                    class="w-full border rounded p-2"
                    required
                >
                    <option value="percentage">Процент</option>
                    <option value="fixed">Фиксированная сумма</option>
                </select>
            </div>

            <div>
                <label for="value" class="block font-medium">Значение</label>
                <input
                    type="number"
                    id="value"
                    v-model="form.value"
                    class="w-full border rounded p-2"
                    placeholder="1.0" step="0.01" min="0" max="10"
                    required
                />
            </div>

            <div>
                <label for="start_date" class="block font-medium">Дата начала</label>
                <input
                    type="date"
                    id="start_date"
                    v-model="form.start_date"
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div>
                <label for="end_date" class="block font-medium">Дата окончания</label>
                <input
                    type="date"
                    id="end_date"
                    v-model="form.end_date"
                    class="w-full border rounded p-2"
                />
            </div>

            <div>
                <label for="max_uses" class="block font-medium">Максимальное количество применений</label>
                <input
                    type="number"
                    id="max_uses"
                    v-model="form.max_uses"
                    class="w-full border rounded p-2"
                />
            </div>

            <div>
                <label for="frequency" class="block font-medium">Частота</label>
                <select
                    id="frequency"
                    v-model="form.frequency"
                    class="w-full border rounded p-2"
                >
                    <option value="">Без ограничения</option>
                    <option value="daily">Раз в день</option>
                    <option value="weekly">Раз в неделю</option>
                </select>
            </div>

            <div>
                <label for="private_users" class="block font-medium">Приватные пользователи (ID через запятую)</label>
                <textarea
                    id="private_users"
                    v-model="form.private_users"
                    class="w-full border rounded p-2"
                ></textarea>
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input
                        type="checkbox"
                        v-model="form.is_active"
                        class="mr-2"
                    />
                    Активен
                </label>
            </div>

            <div v-if="form.errors">
                <p v-for="(error, key) in form.errors" :key="key" class="text-red-500">
                    {{ error }}
                </p>
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded"
                :disabled="form.processing"
            >
                {{ form.processing ? 'Создание...' : 'Создать' }}
            </button>
        </form>
    </div>
</template>

<script>
import {router, useForm} from "@inertiajs/vue3";

export default {
    setup() {
        const form = useForm({
            code: "",
            type: "percentage",
            value: "",
            start_date: "",
            end_date: "",
            is_active: true,
            max_uses: "",
            private_users: "",
            frequency: "",
        });

        const submitForm = () => {
            form.post(router.route(('promos.store')), {
                preserveState: false,
                preserveScroll: true,
                onSuccess: () => {
                    alert("Промокод успешно создан!");
                },
                onError: (errors) => {
                    console.error(errors);
                    alert("Ошибка при создании промокода.");
                },
            });
        };
        //router.post('/promos',form);

        return {form};
    },
};
</script>

<style scoped>
.container {
    max-width: 600px;
}
</style>
