<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// Menerima data buku dari BookController@index
defineProps({
    books: Object,
});
</script>

<template>
    <Head title="Data Buku" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Data Buku
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white shadow-sm rounded-lg p-6">

                    <!-- Judul dan tombol tambah -->
                    <div class="flex justify-between items-center mb-6">

                        <h1 class="text-2xl font-bold text-gray-800">
                            Daftar Buku
                        </h1>

                        <Link
                            href="/books/create"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
                        >
                            + Tambah Buku
                        </Link>

                    </div>

                    <!-- Tabel buku -->
                    <div class="overflow-x-auto">

                        <table class="w-full border-collapse border border-gray-300">

                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-3">No</th>
                                    <th class="border p-3">Kode Buku</th>
                                    <th class="border p-3">Judul</th>
                                    <th class="border p-3">Pengarang</th>
                                    <th class="border p-3">Stok</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr
                                    v-for="(book, index) in books.data"
                                    :key="book.id"
                                    class="hover:bg-gray-50"
                                >
                                    <td class="border p-3 text-center">
                                        {{ books.from + index }}
                                    </td>

                                    <td class="border p-3">
                                        {{ book.kode_buku }}
                                    </td>

                                    <td class="border p-3">
                                        {{ book.judul }}
                                    </td>

                                    <td class="border p-3">
                                        {{ book.pengarang }}
                                    </td>

                                    <td class="border p-3 text-center">
                                        {{ book.stok }}
                                    </td>
                                </tr>

                                <!-- Jika belum ada data -->
                                <tr v-if="books.data.length === 0">
                                    <td
                                        colspan="5"
                                        class="border p-5 text-center text-gray-500"
                                    >
                                        Belum ada data buku.
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <!-- Navigasi halaman -->
                    <div class="flex justify-between mt-5">

                        <Link
                            v-if="books.prev_page_url"
                            :href="books.prev_page_url"
                            class="text-blue-600 hover:underline"
                        >
                            ← Sebelumnya
                        </Link>

                        <Link
                            v-if="books.next_page_url"
                            :href="books.next_page_url"
                            class="text-blue-600 hover:underline"
                        >
                            Selanjutnya →
                        </Link>

                    </div>

                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
