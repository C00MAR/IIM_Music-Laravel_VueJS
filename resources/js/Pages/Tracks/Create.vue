<template>
    <div class="noise"></div>
    <MusicLayout>
        <template #title>
            <h1 class="title">
                Créer une musique :
            </h1>
        </template>
        <template #action>
            <Link :href="route('tracks.index')" class="btn">
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

                <!-- Artiste -->
                <div class="input_container">
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
                <div class="input_container">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="display">
                        Publique
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
                <div class="input_container">
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
                <div class="input_container">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="music">
                        Audio
                    </label>
                    <input
                        id="music"
                        @input="form.music = $event.target.files[0]"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500' : form.errors.music  }"
                        type="file"
                        name="music"
                    >
                </div>
                <input
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                    value="Créer la Musique">
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
            this.form.post(route('tracks.store'));
        }
    }
}
</script>

<style lang="scss">
.input_container {
    display: flex;
    flex-direction: column;
    border-bottom: 1px solid #2A2927;

    label {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        padding: 10px 10px;
    }

    input, select {
        margin-bottom: 1rem;
    }
}
</style>