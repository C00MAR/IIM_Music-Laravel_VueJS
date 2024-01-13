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
            <!-- <div class="container border_style">
                <ul>
                    
                </ul>
            </div> -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Nombre de musique</th>
                        <th>Créée le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                    v-for="(playlist, i) in playlists" 
                    :key="playlist.uuid"
                    >
                        <td>{{ i + 1 }}</td>
                        <td>{{ playlist.title }}</td>
                        <td>{{ playlist.tracks_count }}</td>
                        <td>{{ $moment(playlist.create_at).format("DD/MM/YYYY") }}</td>
                        <td>
                            <Link 
                                :href="route('playlists.show', { playlist: playlist })" class="btn">
                                Voir
                            </Link>
                            <Link 
                                :href="route('playlists.edit', { playlist: playlist })" class="btn">
                                Modifier
                            </Link>
                            <Link
                                :href="route('playlists.destroy', { playlist: playlist })" class="btn" method="delete" as="button">
                                Supprimer
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </MusicLayout>
</template>

<script>
export default {
    components: {
        MusicLayout, Link
    },
    props: {
        playlists: Array,
    }
}
</script>