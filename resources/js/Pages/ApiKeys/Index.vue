<script setup>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="noise"></div>
    <MusicLayout>
        <template #title >
            <h1 class="title">
                Mes Clés API :
            </h1>
        </template>
        <template #action>
            <Link 
            :href="route('apikeys.create')" class="btn">
                Créer une Clé API
            </Link>
        </template>
        <template #content>
            <div class="container border_style">
                <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom de Clé</th>
                        <th>Clé</th>
                        <th>Créée le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                    v-for="(apikey, i) in $page.props.apiKeys" 
                    :key="apikey.uuid"
                    >
                        <td>{{ i + 1 }}</td>
                        <td>{{ apikey.name }}</td>
                        <td>{{ apikey.key }}</td>
                        <td>{{ $moment(apikey.create_at).format("DD/MM/YYYY") }}</td>
                        <td>
                            <Link
                                :href="route('apikeys.destroy', { apikey: apikey })" class="btn" method="delete" as="button">
                                Supprimer
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
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
        apikeys: Array
    },
}
</script>