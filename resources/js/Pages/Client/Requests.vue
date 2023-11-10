<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Filter from  '@/Components/Filter.vue'
import Search from '@/Components/Search.vue'
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Requests
                </h2>
            <div class="flex justify-end items-center space-x-1">
                <Filter/><Search/>
            </div>
            </div>
        </template>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div>Reference Number:</div>
            <div>Document Type:</div> 
            <div>No. of Copies:</div>
            <div>Status:</div>
        </div>
    </AuthenticatedLayout>
</template>
