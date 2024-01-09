<template>
    <MusicLayout>
        <template #title>
            Musiques
        </template>
        <template #action>
            <Link :href="route('tracks.index')">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submitForm">
                <!-- Title -->
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Titre
                    </label>
                    <input
                        id="title"
                        v-model="form.title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.title  }"
                        type="text"
                        placeholder="Title"
                        name="title"
                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.title }}</p>
                </div>

                <!-- Artiste -->
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="artiste">
                        Artiste
                    </label>
                    <input
                        id="artiste"
                        v-model="form.artiste"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.artiste  }"
                        type="text"
                        placeholder="Artiste"
                        name="artiste"
                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.artiste }}</p>
                </div>

                <!-- Public -->
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="display">
                        Publique ?
                    </label>
                    <select 
                        id="display"
                        v-model="form.display"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.display  }"
                        name="display"
                        >
                        <option :value=true>Oui</option>
                        <option :value=false>Non</option>
                    </select>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Image
                    </label>
                    <input
                        id="image"
                        @input="form.image = $event.target.files[0]"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.image  }"
                        type="file"
                        name="image"
                    >
                </div>

                <!-- Audio -->
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="audio">
                        Audio
                    </label>
                    <input
                        id="audio"
                        @input="form.audio = $event.target.files[0]"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.audio  }"
                        type="file"
                        name="audio"
                    >
                </div>
            </form>
            <!-- Sumbit -->
            <input
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit"
            value="Créer la Musique">
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
            test: '',
            form: this.$inertia.form({
                title: '',
                artist: '',
                album: '',
                image: null,
                music: null,
                display: true
            })
        }
    },
    methods: {
        submitForm() {
            this.form.post(route('tracks.store'), {
                onSuccess: () => {
                    this.$inertia.visit(route('tracks.index'))
                }
            })
        }
    }
}
</script>