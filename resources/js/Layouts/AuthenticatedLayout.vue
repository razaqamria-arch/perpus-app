<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import Sidebar from '@/Components/Sidebar.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar kiri -->
        <Sidebar />

        <!-- Konten utama -->
        <div class="flex-1 min-w-0 flex flex-col">

            <!-- Navbar atas -->
            <nav class="bg-white border-b border-gray-100">
                <div class="px-6">
                    <div class="flex justify-between h-16">

                        <!-- Logo dan Dashboard -->
                        <div class="flex items-center gap-6">

                            <Link :href="route('dashboard')">
                                <ApplicationLogo
                                    class="block h-9 w-auto fill-current text-gray-800"
                                />
                            </Link>

                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Dashboard
                            </NavLink>

                        </div>

                        <!-- Profil pengguna -->
                        <div class="flex items-center">

                            <Dropdown align="right" width="48">

                                <template #trigger>
                                    <button
                                        type="button"
                                        class="px-3 py-2 text-sm text-gray-600 hover:text-gray-900"
                                    >
                                        {{ $page.props.auth.user.name }}
                                        ▼
                                    </button>
                                </template>

                                <template #content>

                                    <!-- Logout -->
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>

                                </template>

                            </Dropdown>

                        </div>

                    </div>
                </div>
            </nav>

            <!-- Judul halaman -->
            <header
                v-if="$slots.header"
                class="bg-white shadow"
            >
                <div class="px-6 py-5">
                    <slot name="header" />
                </div>
            </header>

            <!-- Isi halaman -->
            <main class="p-6 flex-1">

                <slot />

            </main>

        </div>

    </div>
</template>
