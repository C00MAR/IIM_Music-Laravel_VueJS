<template>
    <div class="noise"></div>
    <MusicLayout>
        <template #title>
            <h1 class="title">
                Éditer la musique :
            </h1>
            <p>{{ track.title }}</p>
        </template>
        <template #action>
            <Link :href="route('tracks.index')" class="btn">
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="artist">
                        Artiste
                    </label>
                    <input
                        id="artist"
                        v-model="form.artist"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.artist  }"
                        type="text"
                        placeholder="Artiste"
                        name="artist"
                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.artist }}</p>
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


                <input
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                    value="Éditer la Musique">
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
                title: this.track.title,
                artist: this.track.artist,
                display: this.track.display ? true : false,
            })
        }
    },
    props: {
        track: Object,
    },
    methods: {
        submitForm() {
            this.form.put(route('tracks.update', { track: this.track}));
        }
    }
}
</script>