
<script setup>
import Sidebar from '@/Components/Sidebar.vue'
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Page Content -->
        <div class="flex-1 min-w-0">
            <!-- Page Heading -->
            <header
                v-if="$slots.header"
                class="bg-white shadow"
            >
                <div
                    class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"
                >
                    <slot name="header" />
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
