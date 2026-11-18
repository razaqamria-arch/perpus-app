
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

// Form data anggota
const form = useForm({
    nama: '',
    nis_nim: '',
    no_hp: '',
    foto: null,
})

// Preview foto
const previewFoto = ref(null)

// Memilih foto
function pilihFoto(event) {
    const file = event.target.files[0]

    if (file) {
        form.foto = file
        previewFoto.value = URL.createObjectURL(file)
    }
}

// Fungsi menyimpan anggota
function submit() {
    form.post('/members', {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            previewFoto.value = null
        },
    })
}
</script>

<template>
    <Head title="Tambah Anggota" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Tambah Anggota
            </h2>
        </template>

        <div class="p-6">

            <div class="max-w-xl rounded-lg bg-white p-6 shadow">

                <h1 class="mb-6 text-xl font-bold">
                    Form Tambah Anggota
                </h1>

                <form @submit.prevent="submit" class="space-y-4">

                    <!-- Nama -->
                    <div>
                        <label class="mb-1 block font-medium">
                            Nama
                        </label>

                        <input
                            v-model="form.nama"
                            type="text"
                            placeholder="Masukkan nama anggota"
                            class="w-full rounded border px-3 py-2"
                        >

                        <div v-if="form.errors.nama"
                            class="mt-1 text-sm text-red-600">
                            {{ form.errors.nama }}
                        </div>
                    </div>

                    <!-- NIS/NIM -->
                    <div>
                        <label class="mb-1 block font-medium">
                            NIS/NIM
                        </label>

                        <input
                            v-model="form.nis_nim"
                            type="text"
                            placeholder="Masukkan NIS/NIM"
                            class="w-full rounded border px-3 py-2"
                        >

                        <div v-if="form.errors.nis_nim"
                            class="mt-1 text-sm text-red-600">
                            {{ form.errors.nis_nim }}
                        </div>
                    </div>

                    <!-- No HP -->
                    <div>
                        <label class="mb-1 block font-medium">
                            No. HP
                        </label>

                        <input
                            v-model="form.no_hp"
                            type="text"
                            placeholder="Masukkan nomor HP"
                            class="w-full rounded border px-3 py-2"
                        >

                        <div v-if="form.errors.no_hp"
                            class="mt-1 text-sm text-red-600">
                            {{ form.errors.no_hp }}
                        </div>
                    </div>

                    <!-- Foto -->
                    <div>
                        <label class="mb-1 block font-medium">
                            Foto (JPG/PNG, maksimal 2 MB)
                        </label>

                        <input
                            type="file"
                            accept="image/jpeg,image/png,image/webp"
                            @change="pilihFoto"
                            class="w-full rounded border p-2"
                        >

                        <div v-if="form.errors.foto"
                            class="mt-1 text-sm text-red-600">
                            {{ form.errors.foto }}
                        </div>

                        <!-- Preview foto -->
                        <div v-if="previewFoto" class="mt-3">
                            <p class="mb-2 text-sm font-medium">
                                Preview Foto:
                            </p>

                            <img
                                :src="previewFoto"
                                class="h-32 w-32 rounded border object-cover"
                                alt="Preview foto anggota"
                            >
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex gap-3 pt-3">

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded bg-blue-600 px-5 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                        </button>

                        <Link
                            href="/members"
                            class="rounded bg-gray-500 px-5 py-2 text-white hover:bg-gray-600"
                        >
                            Kembali
                        </Link>

                    </div>

                </form>

            </div>

        </div>

    </AuthenticatedLayout>
</template>
