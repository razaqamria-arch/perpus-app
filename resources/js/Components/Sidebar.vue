<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 flex-shrink-0">

        <h2 class="text-lg font-bold mb-6">
            Perpustakaan Mini
        </h2>

        <nav class="space-y-3">

            <Link
                href="/dashboard"
                class="block p-2 rounded hover:bg-gray-700 hover:text-white"
            >
                Dashboard
            </Link>

            <Link
                href="/"
                class="block p-2 rounded hover:bg-gray-700 hover:text-white"
            >
                Beranda
            </Link>

            <Link
                href="/books"
                class="block p-2 rounded hover:bg-gray-700 hover:text-white"
            >
                Data Buku
            </Link>

        </nav>

    </aside>
</template>
