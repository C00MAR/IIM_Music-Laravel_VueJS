<script setup>
import { Link } from '@inertiajs/vue3';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPenToSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
library.add(faPenToSquare, faTrash)
</script>

<template lang="">
    <!-- <div class="noise"></div> -->
    <div class="track_container" :class="{ 'play' : active }">
        <div class="spliter">
            <img :src="`/storage/${track.image}`" alt="track_cover" class="track_cover" @click="playAudio()">
            <div class="info_container">
                <h3 class="track_title" @click="playAudio()">{{ track.title }}</h3>
                <h4 class="track_artist">{{ track.artist }}</h4>
            </div>
        </div>
        <div class="track_info_container">
            <Link
                v-if="this.$page.props.isAdmin"
                :href="route('tracks.edit', { track: track })" class="btn_alt">
                <font-awesome-icon :icon="['fas', 'pen-to-square']" />
            </Link>
            <Link
                v-if="this.$page.props.isAdmin"
                :href="route('tracks.destroy', { track: track })" class="btn_alt" method="delete" as="button">
                <font-awesome-icon :icon="['fas', 'trash']" />
            </Link>
            <p class="track_stream">{{ track.nb_stream }} Stream</p>
            <p class="track_duration">{{ track.duration }}</p>
        </div>
    </div>
</template>


<script>
export default {
    emits: ['playAudio'],
    props: {
        track: Object,
        active: {
            type: Boolean,
            default: false,
        }
    },
    methods: {
        playAudio() {
            this.$emit('playAudio', this.track);
        },
    },components: {
        Link
    }
}
</script>

<style lang="scss">
.btn_alt {
    background-color: transparent;
    border: none;
    padding: 0;
    margin: 0;
    font-size: 1rem;
    padding: 0.5rem;
    border-radius: 32px;
    height: 2rem;
    width: 2rem;
    align-items: center;
    display: flex;
    justify-content: center;
}

.track_container:hover {
    .btn_alt {
        cursor: pointer;
        color: #e6ded6;
        background-color: transparent;
        transition: all 0.2s ease-in-out;

        &:hover {
            background-color: #e6ded6;
            color: #2A2927;
        }
    }
}
</style>