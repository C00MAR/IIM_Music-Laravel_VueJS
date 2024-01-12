<template>
    <div class="noise"></div>
    <MusicLayout>
        <template #title>
            <h1 class="title">
                Créer une Playlist :
            </h1>
        </template>
        <template #action>
            <Link :href="route('playlists.index')" class="btn">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submitForm" class="form border_style">
                <!-- Title -->
                <div class="input_container">
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

                <!-- Tracks Selector -->
                <div
                v-for="track in tracks"
                :key="track.uuid">
                    <input 
                    type="checkbox"
                    name="tracks"
                    :id="track.uuid"
                    :value="track.uuid"
                    v-model="form.tracks"
                    >

                    <label 
                    :for="track.uuid"
                    >
                        <h5>{{ track.title }}</h5> by <p>{{ track.artist }}</p>
                    </label>
                </div>
                <p class="text-red-500 text-xs italic">{{ form.errors.tracks }}</p>


                <input
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                    value="Créer ma Playlist">
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
    props: {
        tracks: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: '',
                tracks: [],
            })
        }
    },
    methods: {
        submitForm() {
            this.form.post(route('playlists.store'));
        }
    }
}

</script>