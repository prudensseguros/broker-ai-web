<!-- resources/js/Pages/Chat/Index.vue -->
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import { MessageSquare, Menu, Shield, Sparkles, X } from 'lucide-vue-next'

defineProps<{
    canLogin?: boolean
    canRegister?: boolean
}>()

// Estado del componente
const isChatLoading = ref(true)
const isMobileMenuOpen = ref(false)

// Configuración del chatkit
const CHATKIT_URL = import.meta.env.VITE_CHATKIT_URL || 'https://openai-chatkit-starter-app-olive-eta.vercel.app'

// Simular carga del iframe
onMounted(() => {
    setTimeout(() => {
        isChatLoading.value = false
    }, 1500)
})
</script>

<template>
    <Head title="Cotizá tu Seguro" />

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <!-- Background decorativo -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute left-1/2 top-0 h-[500px] w-[500px] -translate-x-1/2 rounded-full bg-gradient-to-br from-blue-100 to-blue-50 opacity-30 blur-3xl dark:from-blue-900 dark:to-blue-950"></div>
        </div>

        <div class="relative flex min-h-screen flex-col items-center selection:bg-blue-500 selection:text-white">
            <div class="relative w-full max-w-7xl px-6">
                <!-- Header / Navigation -->
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <!-- Logo -->
                    <div class="flex items-center gap-2 lg:col-start-2 lg:justify-center">
                        <Shield class="h-10 w-10 text-blue-600 dark:text-blue-500" />
                        <span class="text-2xl font-semibold text-black dark:text-white">
                            Broker<span class="text-blue-600 dark:text-blue-500">AI</span>
                        </span>
                    </div>

                    <!-- Desktop Navigation -->
                    <nav v-if="canLogin" class="hidden lg:flex lg:flex-1 lg:justify-end lg:gap-2">
                        <Link
                            v-if="$page.props.auth?.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-600 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-blue-500"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-600 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-blue-500"
                            >
                                Ingresar
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-600 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-blue-500"
                            >
                                Registrarse
                            </Link>
                        </template>
                    </nav>

                    <!-- Mobile Menu Button -->
                    <button
                        v-if="canLogin"
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="lg:hidden justify-self-end rounded-md p-2 text-black transition hover:bg-gray-100 dark:text-white dark:hover:bg-zinc-800"
                    >
                        <Menu v-if="!isMobileMenuOpen" class="h-6 w-6" />
                        <X v-else class="h-6 w-6" />
                    </button>
                </header>

                <!-- Mobile Menu -->
                <div
                    v-if="canLogin && isMobileMenuOpen"
                    class="lg:hidden mb-6 rounded-lg bg-white p-4 shadow-lg dark:bg-zinc-900"
                >
                    <nav class="flex flex-col gap-2">
                        <Link
                            v-if="$page.props.auth?.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black transition hover:bg-gray-100 dark:text-white dark:hover:bg-zinc-800"
                            @click="isMobileMenuOpen = false"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black transition hover:bg-gray-100 dark:text-white dark:hover:bg-zinc-800"
                                @click="isMobileMenuOpen = false"
                            >
                                Ingresar
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black transition hover:bg-gray-100 dark:text-white dark:hover:bg-zinc-800"
                                @click="isMobileMenuOpen = false"
                            >
                                Registrarse
                            </Link>
                        </template>
                    </nav>
                </div>

                <!-- Main Content -->
                <main class="mt-6">
                    <!-- Hero Section -->
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 dark:bg-blue-900/30 mb-6">
                            <Sparkles class="h-4 w-4 text-blue-600 dark:text-blue-400" />
                            <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                Cotización inteligente con IA
                            </span>
                        </div>

                        <h1 class="text-4xl font-bold tracking-tight text-black dark:text-white sm:text-5xl mb-4">
                            Cotizá tu seguro en minutos
                        </h1>
                        
                        <p class="text-lg text-black/70 dark:text-white/70 max-w-2xl mx-auto">
                            Nuestro asistente con IA te ayudará a encontrar la cobertura perfecta para tu vehículo
                        </p>
                    </div>

                    <!-- Chat Container -->
                    <div class="max-w-5xl mx-auto">
                        <div class="overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 dark:bg-zinc-900 dark:ring-zinc-800">
                            <!-- Chat Header -->
                            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 dark:from-blue-700 dark:to-blue-800">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20">
                                            <MessageSquare class="h-5 w-5 text-white" />
                                        </div>
                                        <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-blue-700 bg-green-400"></div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-white">Asistente Virtual</h3>
                                        <p class="text-sm text-blue-100">Siempre disponible</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Iframe Container -->
                            <div class="relative h-[600px] bg-gray-50 dark:bg-zinc-950">
                                <!-- Loading State -->
                                <div 
                                    v-if="isChatLoading"
                                    class="absolute inset-0 flex flex-col items-center justify-center"
                                >
                                    <div class="relative">
                                        <div class="h-16 w-16 animate-spin rounded-full border-4 border-blue-200 border-t-blue-600 dark:border-blue-900 dark:border-t-blue-500"></div>
                                        <MessageSquare class="absolute inset-0 m-auto h-6 w-6 text-blue-600 dark:text-blue-500" />
                                    </div>
                                    <p class="mt-4 font-medium text-black dark:text-white">Iniciando chat...</p>
                                    <p class="text-sm text-black/50 dark:text-white/50">Conectando con el asistente</p>
                                </div>

                                <!-- Iframe -->
                                <iframe
                                    v-else
                                    :src="CHATKIT_URL"
                                    class="h-full w-full border-0"
                                    title="Chat de Cotización"
                                    allow="microphone"
                                />
                            </div>
                        </div>

                        <!-- Trust Indicators -->
                        <div class="mt-8 flex flex-wrap justify-center gap-6 text-sm text-black/60 dark:text-white/60">
                            <div class="flex items-center gap-2">
                                <div class="h-2 w-2 rounded-full bg-green-500"></div>
                                <span>Respuesta inmediata</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                                <span>100% seguro</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="h-2 w-2 rounded-full bg-purple-500"></div>
                                <span>Sin compromiso</span>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Footer -->
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    <p>© 2025 BrokerAI. Todos los derechos reservados.</p>
                </footer>
            </div>
        </div>
    </div>
</template>