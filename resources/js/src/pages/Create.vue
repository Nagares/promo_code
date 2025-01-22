<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Создать промокод</h1>
        <form @submit.prevent="submit" class="space-y-4">
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
                    step="0.01"
                    required
                />
            </div>

            <div>
                <label for="start_date" class="block font-medium">Дата начала</label>
                <input
                    type="datetime-local"
                    id="start_date"
                    v-model="form.start_date"
                    class="w-full border rounded p-2"
                />
            </div>

            <div>
                <label for="end_date" class="block font-medium">Дата окончания</label>
                <input
                    type="datetime-local"
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
                <label for="private_users" class="block font-medium">Приватные пользователи (JSON)</label>
                <textarea
                    id="private_users"
                    v-model="form.private_users"
                    class="w-full border rounded p-2"
                    placeholder='Например: ["1", "2", "3"]'
                ></textarea>
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
                <label class="inline-flex items-center">
                    <input
                        type="checkbox"
                        v-model="form.is_active"
                        class="mr-2"
                    />
                    Активен
                </label>
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded"
            >
                Создать
            </button>
        </form>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    setup() {
        const form = reactive({
            code: "",
            type: "fixed",
            value: 0,
            start_date: "",
            end_date: "",
            is_active: true,
            max_uses: null,
            private_users: "[]",
            frequency: "",
        });

        const submit = async () => {
            try {
                const response = await fetch("/promos", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify(form),
                });

                if (!response.ok) {
                    throw await response.json();
                }

                alert("Промокод успешно создан!");
            } catch (error) {
                console.error("Ошибка создания промокода:", error);
            }
        };

        return {form, submit};
    },
};
</script>
