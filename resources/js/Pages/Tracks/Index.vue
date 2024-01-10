<script setup>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';
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
            <Link :href="route('tracks.create')" class="btn">
            Créer une musique
            </Link>
        </template>
        <template #content>
            <div class="container border_style">
                <ul>
                    <div class="track_container" v-for="track in filteredTracks" :key="track.uuid">
                        <div class="spliter">
                            <img :src="`/storage/${track.image}`" alt="track_cover" class="track_cover" @click="playAudio(track)">
                            <div class="info_container">
                                <h3 class="track_title" @click="playAudio(track)">{{ track.title }}</h3>
                                <h4 class="track_artist">{{ track.artist }}</h4>
                            </div>
                        </div>
                        <!-- <div class="track_player">
                            <audio controls :src="`/storage/${track.music}`"></audio>
                        </div> -->
                        <div class="track_info_container">
                            <p class="track_stream">{{ track.nb_stream }} Stream</p>
                            <p class="track_duration">{{ track.duration }}</p>
                        </div>
                    </div>
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
        playAudio(track) {
            const audioUrl = '/storage/'+ track.music;
            if (!this.currentTrack) {
                this.audio = new Audio(audioUrl);
                this.audio.play();
            } else if (this.currentTrack.uuid !== track.uuid) {
                this.audio.pause();
                this.audio.src = audioUrl;
                this.audio.play();
            } else if (this.audio.paused) {
                this.audio.play();
            } else {
                this.audio.play();
            }
            this.currentTrack = track;
            this.audio.addEventListener('ended', () => {
                this.currentTrack = null;
            });
        },
        handleSearchUpdate(value) {
            this.search = value;
        },
    }
}
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    transition: all 0.2s ease-in-out;
}

body {
    font-family: 'Lato', sans-serif;
    background-color: #e6ded6;
}

p,
h1,
h2,
h3,
h4,
h5,
h6,
a,
span {
    font-family: 'Lato', sans-serif;
    color: #2A2927;
    text-decoration: none;
}

.noise::before {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    content: "";
    opacity: 0.05;
    z-index: 1000;
    pointer-events: none;
    background: url(../../../../public/noise.gif);
}

.track_container{
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #2A2927;

    .spliter{
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .track_cover {
        width: 6rem;
        height: 6rem;
    }

    .info_container{
        display: flex;
        flex-direction: column;
        width: 20vw;

        .track_title {
            font-weight: 900;
            font-size: 1.3rem;
            transition: all 0s ease-in-out;

            &:hover {
                cursor: pointer;
                text-decoration: underline;
            }
        }

        .track_artist {
            font-weight: 300;
            font-size: 0.8rem;
            &:hover {
                font-weight: 900;
                cursor: pointer;
            }
        }
    }

    .track_player {
        audio {
            width: 50vw;    
        }
        audio::-webkit-media-controls-panel {
            background-color: #2A2927;
        }
        audio::-webkit-media-controls-panel {
            background-color: #e6ded6;
        }
        audio::-webkit-media-controls-play-button {
            background-color: #e6ded6;

            &:hover {
                background-color: #2a292720;
                border-radius: 32px;
            }
        }
    }

    .track_info_container {
        margin-right: 2rem;
        display: flex;
        gap: 1rem;
        align-items: center;

        .track_stream {
            font-size: 0.65rem;
            font-weight: 300;
        }
        .track_duration {
            font-weight: 600;
        }
    }
}
</style>