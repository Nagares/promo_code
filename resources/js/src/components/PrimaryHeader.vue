<template>
    <header>
    <!-- Navbar -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="#" class="text-lg font-bold text-gray-800">MyApp</a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden md:flex space-x-8">
                        <a
                            aria-current="page"
                            class="block text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium nav-link"
                            href="/"
                        > Home
                        </a>
                        <a
                            class="block text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium nav-link"
                            href="/create"
                        >Create
                        </a>
                    </div>
                    <!-- Mobile Menu Button -->
                    <div class="-mr-2 flex md:hidden">
                        <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a
                        aria-current="page"
                        class="block text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium nav-link"
                        href="/"
                    > Home
                    </a>
                    <a
                        class="block text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-base font-medium nav-link"
                        href="/create"
                    >Create
                    </a>
                </div>
            </div>
        </nav>
    </header>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Home from "../pages/Home.vue";

export default defineComponent({
    components: {Home},
    setup() {
        return {};
    },
});
</script>

<style lang="less" scoped>
.header {
    width: 992px;
    margin: 0 auto;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
