<script>
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
        <div class="container">
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
                            <a v-for="(item, index) in navigation" :key="item.name" :href="item.href" class="link"
                                :class="{ 'last_link': index === navigation.length - 1 }"
                                :aria-current="item.current ? 'page' : undefined">
                                {{ item.name }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="search_container">
                    <input type="search" name="search_track" id="search_track" v-model="search" @input="updateSearch">
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center sm:static profil_picture_container">
                
                    <!-- Profile dropdown -->
                    <Menu as="div" class="relative ml-3">
                        <div>
                            <MenuButton
                                class="profil_picture">
                                <span class="absolute -inset-1.5" />
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="" />
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem v-slot="{ active }">
                                <a href="#"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your
                                    Profile</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <a href="#"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Settings</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <a href="#"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Sign
                                    out</a>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
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
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'

const navigation = [
    { name: 'Dashboard', href: '#', current: true },
    { name: 'Team', href: '#', current: false },
    { name: 'Projects', href: '#', current: false },
    { name: 'Calendar', href: '#', current: false },
]
</script>

<style lang="scss">
.nav {
    border-bottom: 1px solid #2A2927;

    .link {
        border-left: 1px solid #2A2927;
        width: 7vw;
        height: 10vh;
        display: flex;
        align-items: center;
        justify-content: center;

        &.last_link {
            border-right: 1px solid #2A2927;
        }

        &:hover {
            background-color: #2A2927;
            color: #e6ded6;
        }
    }
    .profil_picture_container {
        padding: 10px;
        padding-right: 2vw;
        border-right: 1px solid #2A2927;

        .profil_picture {
            border: 1px solid #101010;
            padding: 5px;
            border-radius: 32px;

            &:hover {
                background-color: #2A2927;
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

    &:hover {
        border-radius: 8px;
        background-color: #0f0f0f;
    }
}
</style>