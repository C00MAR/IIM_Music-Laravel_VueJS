<script setup>
import { Link } from '@inertiajs/vue3';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPenToSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
library.add(faPenToSquare, faTrash)
</script>

<template lang="">
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
    components: {
        Link
    }
}
</script>
