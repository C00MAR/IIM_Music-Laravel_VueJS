<script setup>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="noise"></div>
    <MusicLayout >
        <template #title >
            <h1 class="title">
                Playlist :
            </h1>
        </template>
        <template #action>
            <Link 
            :href="route('playlists.create')" class="btn">
                Créer ma playlist
            </Link>
        </template>
        <template #content>
            <div class="container border_style">
                <ul>
                    COMPOSANT
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
export default {
    components: {
        MusicLayout, Link
    }
}
</script>