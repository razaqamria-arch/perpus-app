
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

// Menerima data anggota dari MemberController
const props = defineProps({
    member: Object,
})

// Form edit anggota
const form = useForm({
    _method: 'put',
    nama: props.member.nama,
    nis_nim: props.member.nis_nim,
    no_hp: props.member.no_hp ?? '',
    foto: null,
})

// Preview foto baru
const pratinjau = ref(null)

// Fungsi memilih foto baru
function pilihFoto(event) {
    const berkas = event.target.files[0]

    if (berkas) {
        form.foto = berkas
        pratinjau.value = URL.createObjectURL(berkas)
    } else {
        form.foto = null
        pratinjau.value = null
    }
}

// Fungsi menyimpan perubahan
function submit() {
    form.post(route('members.update', props.member.id), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            pratinjau.value = null
        },
    })
}
</script>

<template>
    <Head title="Edit Anggota" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">
                Edit Anggota
            </h2>
        </template>

        <div class="p-6">

            <div class="max-w-xl rounded-lg bg-white p-6 shadow">

                <h1 class="mb-6 text-xl font-bold">
                    Form Edit Anggota
                </h1>

                <form
                    @submit.prevent="submit"
                    class="space-y-4"
                >

                    <!-- Nama -->
                    <div>
                        <label class="mb-1 block font-medium">
                            Nama
                        </label>

                        <input
                            v-model="form.nama"
                            type="text"
                            class="w-full rounded border px-3 py-2"
                        >

                        <div
                            v-if="form.errors.nama"
                            class="mt-1 text-sm text-red-600"
                        >
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
                            class="w-full rounded border px-3 py-2"
                        >

                        <div
                            v-if="form.errors.nis_nim"
                            class="mt-1 text-sm text-red-600"
                        >
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
                            class="w-full rounded border px-3 py-2"
                        >

                        <div
                            v-if="form.errors.no_hp"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.no_hp }}
                        </div>
                    </div>

                    <!-- Foto lama -->
                    <div>
                        <label class="mb-2 block font-medium">
                            Foto Saat Ini
                        </label>

                        <img
                            v-if="props.member.foto"
                            :src="`/storage/${props.member.foto}`"
                            alt="Foto anggota"
                            class="h-32 w-32 rounded border object-cover"
                        >

                        <span
                            v-else
                            class="text-sm text-gray-500"
                        >
                            Belum ada foto.
                        </span>
                    </div>

                    <!-- Upload foto baru -->
                    <div>
                        <label class="mb-1 block font-medium">
                            Ganti Foto
                        </label>

                        <p class="mb-2 text-sm text-gray-500">
                            Kosongkan jika tidak ingin mengganti foto.
                            Format JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
                        </p>

                        <input
                            type="file"
                            accept="image/jpeg,image/png,image/webp"
                            @change="pilihFoto"
                            class="w-full rounded border p-2"
                        >

                        <div
                            v-if="form.errors.foto"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.foto }}
                        </div>

                        <!-- Preview foto baru -->
                        <div v-if="pratinjau" class="mt-3">

                            <p class="mb-2 text-sm font-medium">
                                Preview Foto Baru:
                            </p>

                            <img
                                :src="pratinjau"
                                alt="Preview foto baru"
                                class="h-32 w-32 rounded border object-cover"
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
                            {{
                                form.processing
                                    ? 'Menyimpan...'
                                    : 'Simpan Perubahan'
                            }}
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
