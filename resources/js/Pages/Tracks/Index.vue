<script setup>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';
import MusicTile from '@/Components/TracksComps/MusicTile.vue';
</script>

<template>
    <div class="noise"></div>
    <MusicLayout @searchUp="handleSearchUpdate">
        <template #title >
            <h1 class="title">
                Musiques :
            </h1>
        </template>
        <template #action>
            <Link 
            v-if="this.$page.props.isAdmin"
            :href="route('tracks.create')" class="btn">
                Créer une musique
            </Link>
        </template>
        <template #content>
            <div class="container border_style">
                <ul>
                    <MusicTile 
                    v-for="track in filteredTracks" 
                    :key="track.uuid" 
                    :track="track"
                    :active="currentTrack"
                    @playAudio="playMusic"/>
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
export default {
    components: {
        MusicLayout, Link, MusicTile
    },
    props: {
        tracks: Array,
    },
    emits: {
        'search': null
    },
    computed: {
        filteredTracks() {
            return this.tracks.filter(track => track.title.toLowerCase().includes(this.search.toLowerCase()) || track.artist.toLowerCase().includes(this.search.toLowerCase()));
        },
    },
    data() {
        return {
            search: '',
            audio: null,
            currentTrack: null,
        }
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
        },
        handleSearchUpdate(value) {
            this.search = value;
        },
    }
}
</script>
