<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    book: Object,
})

// Mengisi form menggunakan data buku yang sudah ada
const form = useForm({
    kode_buku: props.book.kode_buku ?? '',
    judul: props.book.judul ?? '',
    pengarang: props.book.pengarang ?? '',
    penerbit: props.book.penerbit ?? '',
    tahun: props.book.tahun ?? '',
    stok: props.book.stok ?? 0,
})

// Fungsi menyimpan perubahan buku
function submit() {
    form.put(route('books.update', props.book.id))
}
</script>

<template>
    <Head title="Edit Buku" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Buku
            </h2>
        </template>

        <div class="p-6">
            <div class="max-w-2xl rounded-lg bg-white p-6 shadow">

                <form @submit.prevent="submit">

                    <!-- Kode Buku -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium">
                            Kode Buku
                        </label>

                        <input
                            v-model="form.kode_buku"
                            type="text"
                            class="w-full rounded border-gray-300"
                        >

                        <div v-if="form.errors.kode_buku" class="text-red-600">
                            {{ form.errors.kode_buku }}
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium">
                            Judul Buku
                        </label>

                        <input
                            v-model="form.judul"
                            type="text"
                            class="w-full rounded border-gray-300"
                        >

                        <div v-if="form.errors.judul" class="text-red-600">
                            {{ form.errors.judul }}
                        </div>
                    </div>

                    <!-- Pengarang -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium">
                            Pengarang
                        </label>

                        <input
                            v-model="form.pengarang"
                            type="text"
                            class="w-full rounded border-gray-300"
                        >

                        <div v-if="form.errors.pengarang" class="text-red-600">
                            {{ form.errors.pengarang }}
                        </div>
                    </div>

                    <!-- Penerbit -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium">
                            Penerbit
                        </label>

                        <input
                            v-model="form.penerbit"
                            type="text"
                            class="w-full rounded border-gray-300"
                        >
                    </div>

                    <!-- Tahun -->
                    <div class="mb-4">
                        <label class="mb-1 block font-medium">
                            Tahun Terbit
                        </label>

                        <input
                            v-model="form.tahun"
                            type="number"
                            class="w-full rounded border-gray-300"
                        >
                    </div>

                    <!-- Stok -->
                    <div class="mb-6">
                        <label class="mb-1 block font-medium">
                            Stok Buku
                        </label>

                        <input
                            v-model="form.stok"
                            type="number"
                            min="0"
                            class="w-full rounded border-gray-300"
                        >

                        <div v-if="form.errors.stok" class="text-red-600">
                            {{ form.errors.stok }}
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex gap-3">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Menyimpan...' : 'Simpan Perubahan' }}
                        </button>

                        <Link
                            :href="route('books.index')"
                            class="rounded bg-gray-500 px-4 py-2 text-white hover:bg-gray-600"
                        >
                            Kembali
                        </Link>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
