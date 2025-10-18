<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';


// Asumsi rute otentikasi (login/register) sudah didefinisikan oleh Breeze/Jetstream
const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

// Anda bisa mendefinisikan rute di sini jika tidak menggunakan props canLogin/canRegister
const loginRoute = route('login');
const registerRoute = route('register');
</script>

<template>

    <Head title="NTask | Kelola Tugas dengan Produktif" />

    <div class="font-sans bg-gray-50 text-gray-900 min-h-screen">

        <header class="bg-white shadow-sm sticky top-0 z-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">

                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />



                <div class="flex items-center space-x-3">
                    <Link v-if="props.canLogin" :href="loginRoute"
                        class="text-indigo-600 font-medium hover:text-indigo-700 transition">Masuk</Link>
                    <Link v-if="props.canRegister" :href="registerRoute"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition shadow-md">
                    Coba Gratis</Link>
                </div>
            </div>
        </header>

        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-12 text-center">

            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight mb-6">
                Ambil Kendali, <br class="hidden sm:inline" /><span class="text-indigo-600">Selesaikan Lebih
                    Cepat.</span>
            </h1>

            <p class="text-xl text-gray-600 mb-10 max-w-3xl mx-auto">
                 NTask adalah solusi minimalis yang memanfaatkan Laravel dan Vue/Inertia untuk pengalaman manajemen
                tugas yang sangat cepat dan tanpa *page reload*.
            </p>

            <div class="space-x-4">
                <Link :href="registerRoute"
                    class="px-8 py-3 bg-indigo-600 text-white text-lg font-semibold rounded-xl shadow-xl hover:bg-indigo-700 transition transform hover:scale-105 inline-block">
                Mulai Sekarang, Gratis</Link>
                <a href="#features"
                    class="px-8 py-3 text-indigo-600 text-lg font-semibold rounded-xl border border-indigo-200 hover:bg-indigo-50 transition inline-block">Lihat
                    Fitur</a>
            </div>

            <div class="mt-16 overflow-hidden rounded-xl shadow-2xl border-4 border-white/50">
                <img src="/images/banner.png" alt="NTask Dashboard Mockup" class="w-full h-auto object-cover" />
            </div>
        </section>

        <section id="features" class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Utama, Dibangun untuk Kecepatan</h2>
                <p class="text-lg text-gray-500 mb-12">Menggabungkan stabilitas *backend* dengan fluiditas *frontend*.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-left">

                    <div
                        class="p-6 bg-gray-50 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:border-indigo-400 border-2 border-transparent">
                        <div class="text-4xl text-indigo-600 mb-4">⚡</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Performa SPA Instan</h3>
                        <p class="text-gray-600">Berkat Inertia, navigasi, *submit* form, dan *update* status tugas
                            terjadi tanpa *page reload*. Pengalaman SPA sejati.</p>
                    </div>

                    <div
                        class="p-6 bg-gray-50 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:border-green-400 border-2 border-transparent">
                        <div class="text-4xl text-green-600 mb-4">✅</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Prioritas & Batas Waktu</h3>
                        <p class="text-gray-600">Atur Prioritas (Tinggi/Sedang/Rendah) dan Tanggal Jatuh Tempo.
                            Memastikan Anda selalu fokus pada tugas yang paling penting.</p>
                    </div>

                    <div
                        class="p-6 bg-gray-50 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:border-red-400 border-2 border-transparent">
                        <div class="text-4xl text-red-600 mb-4">🔒</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Keamanan Solid</h3>
                        <p class="text-gray-600">Dibangun di atas Laravel, data Anda dilindungi oleh *middleware*
                            otentikasi dan keamanan terbaik di industri.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-gray-900 py-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
                <div class="bg-indigo-600 p-8 rounded-xl shadow-2xl mb-10">
                    <h3 class="text-3xl font-bold text-white mb-4">Siap Memulai? Daftar Sekarang!</h3>
                    <p class="text-indigo-100 mb-6 max-w-lg mx-auto">Gratis untuk dicoba. Tidak perlu kartu kredit.</p>
                    <Link :href="registerRoute"
                        class="px-10 py-3 bg-white text-indigo-600 text-xl font-bold rounded-xl shadow-xl hover:bg-gray-100 transition transform hover:scale-105 inline-block">
                    Daftar Sekarang</Link>
                </div>

                <p>&copy; 2025 NTask. Hak Cipta Dilindungi. | Dibangun dengan Laravel, Vue, dan Inertia.</p>
                <div class="mt-4 space-x-4">
                    <a href="#" class="hover:text-white transition">Ketentuan Layanan</a>
                    <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                </div>
            </div>
        </footer>
    </div>
</template>