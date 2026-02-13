<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
<!--                    agregamos card de muestra-->

                        <v-card
                            class="mx-auto"
                            color="surface-variant"
                            image="https://cdn.vuetifyjs.com/docs/images/cards/dark-beach.jpg"
                            max-width="440"
                            subtitle="Take a walk down the beach"
                            title="Evening sunset"
                        >
                            <template v-slot:actions>
                                <v-btn
                                    append-icon="mdi-chevron-right"
                                    color="red-lighten-2"
                                    text="Book Activity"
                                    variant="outlined"
                                    block
                                ></v-btn>
                            </template>
                        </v-card>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
