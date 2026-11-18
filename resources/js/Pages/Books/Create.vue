<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    kode_buku: '',
    judul: '',
    pengarang: '',
    penerbit: '',
    tahun: '',
    stok: 0,
});

// Mengirim data buku ke BookController
function submit() {
    form.post(route('books.store'));
}
</script>

<template>
    <Head title="Tambah Buku" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">

                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            Tambah Buku
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Silakan isi formulir untuk menambahkan data buku baru.
                        </p>
                    </div>

                    <form @submit.prevent="submit">

                        <!-- Kode Buku -->
                        <div class="mb-4">
                            <label class="block font-medium mb-2">
                                Kode Buku
                            </label>

                            <input
                                v-model="form.kode_buku"
                                type="text"
                                placeholder="Masukkan kode buku"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                            >

                            <div v-if="form.errors.kode_buku"
                                class="text-red-500 text-sm mt-1">
                                {{ form.errors.kode_buku }}
                            </div>
                        </div>

                        <!-- Judul -->
                        <div class="mb-4">
                            <label class="block font-medium mb-2">
                                Judul Buku
                            </label>

                            <input
                                v-model="form.judul"
                                type="text"
                                placeholder="Masukkan judul buku"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                            >

                            <div v-if="form.errors.judul"
                                class="text-red-500 text-sm mt-1">
                                {{ form.errors.judul }}
                            </div>
                        </div>

                        <!-- Pengarang -->
                        <div class="mb-4">
                            <label class="block font-medium mb-2">
                                Pengarang
                            </label>

                            <input
                                v-model="form.pengarang"
                                type="text"
                                placeholder="Masukkan nama pengarang"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                            >

                            <div v-if="form.errors.pengarang"
                                class="text-red-500 text-sm mt-1">
                                {{ form.errors.pengarang }}
                            </div>
                        </div>

                        <!-- Penerbit -->
                        <div class="mb-4">
                            <label class="block font-medium mb-2">
                                Penerbit
                            </label>

                            <input
                                v-model="form.penerbit"
                                type="text"
                                placeholder="Masukkan nama penerbit"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                            >

                            <div v-if="form.errors.penerbit"
                                class="text-red-500 text-sm mt-1">
                                {{ form.errors.penerbit }}
                            </div>
                        </div>

                        <!-- Tahun -->
                        <div class="mb-4">
                            <label class="block font-medium mb-2">
                                Tahun Terbit
                            </label>

                            <input
                                v-model="form.tahun"
                                type="number"
                                placeholder="Contoh: 2024"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                            >

                            <div v-if="form.errors.tahun"
                                class="text-red-500 text-sm mt-1">
                                {{ form.errors.tahun }}
                            </div>
                        </div>

                        <!-- Stok -->
                        <div class="mb-6">
                            <label class="block font-medium mb-2">
                                Stok Buku
                            </label>

                            <input
                                v-model.number="form.stok"
                                type="number"
                                min="0"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                            >

                            <div v-if="form.errors.stok"
                                class="text-red-500 text-sm mt-1">
                                {{ form.errors.stok }}
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="flex items-center gap-3">

                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md disabled:opacity-50"
                            >
                                {{ form.processing ? 'Menyimpan...' : 'Simpan Buku' }}
                            </button>

                            <Link
                                :href="route('books.index')"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-md"
                            >
                                Kembali
                            </Link>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
