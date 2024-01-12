<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
library.add(faMagnifyingGlass)

export default {
    props: {
        tracks: Array,
    },
    emits: ['searchUp'],
    data() {
        return {
            search: '',
        }
    },
    methods: {
        updateSearch() {
            this.$emit('searchUp', this.search);
        }
    }

}
</script>

<template>
    <Disclosure as="nav" class="nav" v-slot="{ open }">
        <div class="container border_style nav">
            <div class="relative flex items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <DisclosureButton
                        class="relative inline-flex items-center justify-center rounded-md p-2 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start container">
                    <div class="hidden sm:block">
                        <div class="flex">
                            <Link :href="route('tracks.index')" class="link"
                                :class="[route().current().includes('tracks') ? 'active_tab' : '']">
                            Musiques
                            </Link>
                            <Link :href="route('playlists.index')" class="link"
                                :class="[route().current().includes('playlists') ? 'active_tab' : '']">
                            Playlists
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="search_container">
                    <font-awesome-icon :icon="['fas', 'magnifying-glass']" class="icon" />
                    <input type="search" name="search_track" id="search_track" v-model="search" @input="updateSearch"
                        placeholder="Search">
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center sm:static profil_picture_container">

                    <!-- Profile dropdown -->
                    <div class="login_container">
                        <Link v-if="!$page.props.auth.user" :href="route('login')" class="profil_picture login_btn">
                        <p class="not-hovered">L</p>
                        <p class="hovered">Login</p>
                        </Link>
                        <Link v-if="!$page.props.auth.user" :href="route('register')" class="profil_picture login_btn">
                        <p class="not-hovered">R</p>
                        <p class="hovered">Register</p>
                        </Link>
                        <Link v-if="$page.props.auth.user" :href="route('logout')" method="post" as="button"
                            class="profil_picture login_btn">
                        <p class="not-hovered">L</p>
                        <p class="hovered">Logout</p>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <DisclosurePanel class="sm:hidden">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href"
                    :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']"
                    :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>

    <div class="container border_style px-8">
        <div class="flex justify-between items-center">
            <h4 class="title_container my-6">
                <slot name="title"></slot>
            </h4>
            <div>
                <slot name="action"></slot>
            </div>
        </div>
    </div>
    <slot name="content"></slot>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
</script>

<style lang="scss">
.nav {
    border-bottom: 1px solid #2A2927;

    .link {
        width: 7vw;
        height: 10vh;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease-in-out;
        border-right: 1px solid #2A2927;

        &:hover {
            background-color: #2A2927;
            color: #e6ded6;
        }
    }

    .profil_picture_container {
        padding: 10px;
        height: 10vh;
        transition: all 0.2s ease-in-out;

        .login_container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease-in-out;
    
            .login_btn {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 2rem;
                width: 2rem;
                padding: 5px 10px;
                border: 1px solid #2A2927;
                transition: all 0.2s ease-in-out;

                .not-hovered {
                    display: block;
                    transition: all 0.2s ease-in-out;
                }

                .hovered {
                    display: none;
                    transition: all 0.2s ease-in-out;
                }
            }
        }

        &:hover {
            background-color: #2A2927;

            .login_container {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                
                .login_btn {
                    padding: 10px 5px;
                    border: 1px solid #e6ded6;
                    background-color: #e6ded6;
                    border-radius: 32px;
                    width: 2rem;

                    .not-hovered {
                        display: block;
                        color: #2A2927;
                    }

                    .hovered {
                        display: none;
                        color: #e6ded6;
                    }

                    &:hover {
                        background-color: #2A2927;
                        color: #e6ded6;
                        width: fit-content;
                        padding: 10px 10px;

                        .not-hovered {
                            display: none;
                        }

                        .hovered {
                            display: block;
                        }
                    }
                }
            }
        }
    }


    // .profil_picture {
    //     transition: all 0.2s ease-in-out;
    //     border: 1px solid #2A2927;
    //     padding: 5px;
    //     border-radius: 32px;

    //     &:hover {
    //         background-color: #2A2927;
    //     }
    // }

    .search_container {
        height: 10vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        border-right: 1px solid #2A2927;
        border-left: 1px solid #2A2927;
        padding: 2px 5px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;

        .icon {
            padding: 12px;
        }

        input {
            background-color: transparent;
            border: 0;
            width: 0;
            padding: 0;
            transition: all 0.2s ease-in-out;
        }

        &:hover {
            background-color: #2A2927;
            color: #e6ded6;

            input {
                width: 10vw;
                padding: 5px;
                margin-left: 5px;
                margin-right: 10px;
                border-radius: 0;
                border: 1px solid #2A2927;
                background-color: #e6ded6;
                color: #2A2927;
                transition: all 0.2s ease-in-out;

                &:hover {
                    border-radius: 32px;
                }
            }
        }
    }
}

.container {
    max-width: 75rem;
    margin-left: auto;
    margin-right: auto;

    &.border_style {
        border-left: 1px solid #2A2927;
        border-right: 1px solid #2A2927;
        border-bottom: 1px solid #2A2927;

        &.nav {
            border-bottom: 0;
        }
    }

    .title_container {
        // border-right: 1px solid #2A2927;
        // padding: 1.5rem 7.69rem 1.5rem 2rem;
        font-weight: 900;
        font-size: 1.875rem;
        line-height: 2.25rem;
    }
}

.title {
    font-size: 3rem;
    font-weight: 900;
    font-family: 'Almarena-Mono';
}

.btn {
    padding: 10px;
    background-color: #2A2927;
    color: #e6ded6;
    border: 1px solid transparent;
    letter-spacing: 1px;
    transition: all 0.2s ease-in-out;

    &:hover {
        border-radius: 8px;
        background-color: #0f0f0f;
    }
}
</style>