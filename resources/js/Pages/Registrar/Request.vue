<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Filter from '@/Components/Filter.vue'
import Status from '@/Components/Status.vue'
import Search from '@/Components/Search.vue'

defineProps({
    'title': String,
    'name': String
})
</script>

<template>
    <Registrar title="Registrar" :username="name">
        <template #header>
            <div class="flex justify-end items-center space-x-1">
                <Filter class=""/><Search/>
            </div>
        </template>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 grid grid-cols-2">
            <div>
                <div>Name:</div>
                <div>Student No:</div>
                <div>Document Type:</div>
                <div>No. Copies:</div>
            </div>
            <div class="flex justify-end items-center ">
            
                <Status/>
            </div>  
        </div>
    </Registrar>
</template>