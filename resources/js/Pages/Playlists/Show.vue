<script setup>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import MusicTile from '@/Components/TracksComps/MusicTile.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="noise"></div>
    <MusicLayout>
        <template #title>
            <h1 class="title">
                Playlist : {{ playlist.title }}
            </h1>
        </template>
        <template #action>
            <Link :href="route('playlists.index')" class="btn">
                Retour
            </Link>
        </template>

        <template #content>
            <div class="container border_style">
                <ul>
                    <MusicTile
                    v-for="track in playlist.tracks"
                    :key="track.uuid"
                    :track="track"
                    :active="currentTrack === track"
                    @playAudio="playMusic"
                    >
                    </MusicTile>
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
export default {
    components: {
        MusicLayout, Link
    },
    props: {
        playlist: Object,
    },
    methods: {
        playMusic(track) {
            const audioUrl = '/storage/'+ track.music;
            if (!this.currentTrack) {
                this.audio = new Audio(audioUrl);
                this.audio.play();
            } else if (this.currentTrack.uuid !== track.uuid) {
                this.audio.pause();
                this.audio.src = audioUrl;
                this.audio.play();
            } else if (!this.audio.paused) {
                this.audio.pause();
            } else {
                this.audio.play();
            }

            this.currentTrack = track;
            this.audio.addEventListener('ended', () => this.currentTrack = null);
        }
    },
}
</script>