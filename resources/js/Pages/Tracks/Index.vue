<template>
    <div class="noise"></div>
    <MusicLayout>
        <template #title>
            Musiques
        </template>
        <template #action>
            <Link :href="route('tracks.create')">
            Créer une musique
            </Link>
        </template>
        <template #content>
            <div>
                <ul>
                    <li v-for="track in tracks" :key="track.uuid"
                        :class="[track.id % 2 ? 'text-red-500' : 'text-green-500']">
                        {{ track.title }}
                    </li>
                </ul>
            </div>
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
    }

}
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
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

// .noise::before {
//     position: fixed;
//     top: 0;
//     left: 0;
//     width: 100vw;
//     height: 100vh;
//     content: "";
//     opacity: 0.05;
//     z-index: 1000;
//     pointer-events: none;
//     background: url(../../../../public/noise.gif);
// }
</style>