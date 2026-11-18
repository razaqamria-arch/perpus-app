
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    members: Object,
    search: String,
})

// Menyimpan kata kunci pencarian
const keyword = ref(props.search || '')

// Fungsi pencarian anggota
function cari() {
    router.get('/members', {
        search: keyword.value
    }, {
        preserveState: true,
        preserveScroll: true
    })
}

// Fungsi menghapus anggota
function hapus(id) {
    if (confirm('Yakin ingin menghapus anggota ini?')) {
        router.delete(route('members.destroy', id))
    }
}
</script>

<template>
    <Head title="Data Anggota" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Data Anggota
            </h2>
        </template>

        <div class="p-6">

            <!-- Pesan berhasil -->
            <div
                v-if="$page.props.flash?.success"
                class="mb-4 rounded bg-green-100 p-3 text-green-700"
            >
                {{ $page.props.flash.success }}
            </div>

            <!-- Judul dan tombol tambah -->
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">

                <h1 class="text-xl font-bold text-gray-800">
                    Daftar Anggota
                </h1>

                <Link
                    href="/members/create"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    + Tambah Anggota
                </Link>

            </div>

            <!-- Form pencarian -->
            <div class="mb-4 flex gap-2">

                <input
                    v-model="keyword"
                    @keyup.enter="cari"
                    type="text"
                    placeholder="Cari nama atau NIS/NIM..."
                    class="w-full max-w-sm rounded border border-gray-300 px-3 py-2"
                >

                <button
                    @click="cari"
                    class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700"
                >
                    Cari
                </button>

            </div>

            <!-- Tabel data anggota -->
            <div class="overflow-x-auto rounded-lg bg-white shadow">

                <table class="w-full border-collapse text-left">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="border px-3 py-3">No</th>
                            <th class="border px-3 py-3">Foto</th>
                            <th class="border px-3 py-3">NIS/NIM</th>
                            <th class="border px-3 py-3">Nama</th>
                            <th class="border px-3 py-3">No. HP</th>
                            <th class="border px-3 py-3">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr
                            v-for="(member, index) in members.data"
                            :key="member.id"
                            class="hover:bg-gray-50"
                        >

                            <td class="border px-3 py-2">
                                {{ members.from + index }}
                            </td>

                            <!-- Foto anggota -->
                            <td class="border px-3 py-2">

                                <img
                                    v-if="member.foto"
                                    :src="`/storage/${member.foto}`"
                                    alt="Foto anggota"
                                    class="h-16 w-16 rounded object-cover"
                                >

                                <span v-else class="text-gray-400">
                                    Tidak ada foto
                                </span>

                            </td>

                            <td class="border px-3 py-2">
                                {{ member.nis_nim }}
                            </td>

                            <td class="border px-3 py-2">
                                {{ member.nama }}
                            </td>

                            <td class="border px-3 py-2">
                                {{ member.no_hp || '-' }}
                            </td>

                            <!-- Tombol aksi -->
                            <td class="border px-3 py-2">

                                <div class="flex gap-2">

                                    <Link
                                        :href="`/members/${member.id}/edit`"
                                        class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600"
                                    >
                                        Edit
                                    </Link>

                                    <button
                                        @click="hapus(member.id)"
                                        class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>

                        <!-- Jika data kosong -->
                        <tr v-if="members.data.length === 0">

                            <td
                                colspan="6"
                                class="border px-3 py-5 text-center text-gray-500"
                            >
                                Belum ada data anggota.
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-5 flex flex-wrap gap-2">

                <template
                    v-for="(link, index) in members.links"
                    :key="index"
                >

                    <Link
                        v-if="link.url"
                        :href="link.url"
                        v-html="link.label"
                        class="rounded border px-3 py-2 text-sm"
                        :class="{
                            'bg-blue-600 text-white': link.active,
                            'bg-white hover:bg-gray-100': !link.active
                        }"
                    />

                    <span
                        v-else
                        v-html="link.label"
                        class="rounded border px-3 py-2 text-sm text-gray-400"
                    />

                </template>

            </div>

        </div>
    </AuthenticatedLayout>
</template>
