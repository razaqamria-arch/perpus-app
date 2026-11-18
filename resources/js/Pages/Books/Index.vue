<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

// Menerima data dari BookController
const props = defineProps({
    books: Object,
    search: String,
})

// Menyimpan kata kunci pencarian
const keyword = ref(props.search ?? '')

// Fungsi pencarian buku
function cari() {
    router.get(route('books.index'), {
        search: keyword.value,
    }, {
        preserveState: true,
        replace: true,
    })
}

// Fungsi menghapus buku
function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id))
    }
}

// Fungsi mengosongkan pencarian
function resetCari() {
    keyword.value = ''

    router.get(route('books.index'), {}, {
        preserveState: true,
        replace: true,
    })
}
</script>

<template>
    <Head title="Data Buku" />

    <AuthenticatedLayout>

        <!-- Header halaman -->
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Data Buku
            </h2>
        </template>

        <div class="p-6">

            <!-- Pesan sukses -->
            <div
                v-if="$page.props.flash?.success"
                class="mb-4 rounded bg-green-100 p-3 text-green-700"
            >
                {{ $page.props.flash.success }}
            </div>

            <!-- Tombol tambah buku -->
            <div class="mb-4">
                <Link
                    :href="route('books.create')"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    + Tambah Buku
                </Link>
            </div>

            <!-- Form pencarian -->
            <form
                @submit.prevent="cari"
                class="mb-4 flex flex-wrap gap-2"
            >
                <input
                    v-model="keyword"
                    type="text"
                    placeholder="Cari judul atau pengarang..."
                    class="w-full max-w-sm rounded border border-gray-300 px-4 py-2"
                >

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    Cari
                </button>

                <button
                    type="button"
                    @click="resetCari"
                    class="rounded bg-gray-500 px-4 py-2 text-white hover:bg-gray-600"
                >
                    Reset
                </button>
            </form>

            <!-- Informasi pencarian -->
            <div
                v-if="props.search"
                class="mb-3 text-sm text-gray-600"
            >
                Hasil pencarian untuk:
                <strong>{{ props.search }}</strong>
            </div>

            <!-- Tabel data buku -->
            <div class="overflow-x-auto rounded bg-white shadow">

                <table class="w-full border-collapse">

                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border p-3">No</th>
                            <th class="border p-3">Kode Buku</th>
                            <th class="border p-3">Judul</th>
                            <th class="border p-3">Pengarang</th>
                            <th class="border p-3">Stok</th>
                            <th class="border p-3">Aksi</th>
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

                            <!-- Tombol aksi -->
                            <td class="border p-3">
                                <div class="flex gap-2">

                                    <Link
                                        :href="route('books.edit', book.id)"
                                        class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600"
                                    >
                                        Edit
                                    </Link>

                                    <button
                                        type="button"
                                        @click="hapus(book.id)"
                                        class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700"
                                    >
                                        Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>

                        <!-- Jika data kosong -->
                        <tr v-if="books.data.length === 0">
                            <td
                                colspan="6"
                                class="border p-4 text-center text-gray-500"
                            >
                                Data buku tidak ditemukan.
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Informasi jumlah data -->
            <div
                v-if="books.total > 0"
                class="mt-3 text-sm text-gray-600"
            >
                Menampilkan {{ books.from }} sampai {{ books.to }}
                dari {{ books.total }} buku.
            </div>

            <!-- Navigasi halaman -->
            <div class="mt-4 flex items-center justify-between">

                <Link
                    v-if="books.prev_page_url"
                    :href="books.prev_page_url"
                    class="rounded bg-gray-600 px-4 py-2 text-white hover:bg-gray-700"
                >
                    Sebelumnya
                </Link>

                <span
                    v-else
                    class="rounded bg-gray-200 px-4 py-2 text-gray-400"
                >
                    Sebelumnya
                </span>

                <span class="text-sm text-gray-600">
                    Halaman {{ books.current_page }}
                    dari {{ books.last_page }}
                </span>

                <Link
                    v-if="books.next_page_url"
                    :href="books.next_page_url"
                    class="rounded bg-gray-600 px-4 py-2 text-white hover:bg-gray-700"
                >
                    Selanjutnya
                </Link>

                <span
                    v-else
                    class="rounded bg-gray-200 px-4 py-2 text-gray-400"
                >
                    Selanjutnya
                </span>

            </div>

        </div>

    </AuthenticatedLayout>
</template>
