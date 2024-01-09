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
            <form>
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
                >
                <p class="text-red-500 text-xs italic">{{ form.errors.title }}</p>
                </div>
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
}
</script>