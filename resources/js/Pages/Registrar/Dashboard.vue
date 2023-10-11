<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Chart from '@/Components/Chart.vue'
import { GithubIcon } from '@/Components/Icons/brands'
</script>

<template>
    <Registrar title="Registrar">
        <template #header>
            <div class="grid grid-cols-1 flex justify-center xl:grid-cols-3">
                <div class="p-6 overflow-hidden w-96 h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center text-xl font-bold">
                    Pending
                </div>
                <div class="p-6 overflow-hidden w-96 h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center text-xl font-bold">
                    Completed
                </div>
                <div class="p-6 overflow-hidden w-96 h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center text-xl font-bold">
                    Claimed
                </div>
            </div>
        </template>

        <div class="grid grid-cols-1 xl:grid-cols-2 space-x-2">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <Chart/>
            </div>
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            </div>
        </div>
    </Registrar>
</template>