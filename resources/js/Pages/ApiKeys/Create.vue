<template>
    <div class="noise"></div>
    <MusicLayout>
        <template #title>
            <h1 class="title">
                Créer une Clé API :
            </h1>
        </template>
        <template #action>
            <Link :href="route('apikeys.index')" class="btn">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submitForm" class="form border_style">
                <!-- name -->
                <div class="input_container">
                    <label class="block text-gray-700 text-sm font-bold" for="name">
                        Nom de la Clé
                    </label>
                    <input
                        id="name"
                        v-model="form.name"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.name  }"
                        type="text"
                        placeholder="name"
                        name="name"
                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.name }}</p>
                </div>

                <input
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                    value="Créer la clée">
            </form>
        </template>
    </MusicLayout>
</template>
<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        MusicLayout, Link
    },
    data() {
        return {
            form: this.$inertia.form({
                name: ''
            })
        }
    },
    methods: {
        submitForm() {
            this.form.post(route('apikeys.store'));
        }
    }
}
</script>