<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import PieChart from '@/Components/Chart/PieChart.vue'
import BarChart from '@/Components/Chart/LineChart.vue'

defineProps({
    'title': String,
    'name': String
})
</script>

<template>
    <Registrar title="Registrar" :username="name">
        <template #header>
            <div class="grid grid-cols-1 justify-center xl:grid-cols-3 ">
                <div class="p-6 overflow-hidden w-auto h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center ">
                    <div class="mt-5 text-7xl font-bold">200</div>
                    <div class="text-xl font-bold p-4">
                        <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xl px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pending</button>
                    </div>
                </div>
                <div class="p-6 overflow-hidden w-auto h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center md:ml-0.5 ">
                    <div class="mt-5 text-7xl font-bold">80</div>
                    <div class="text-xl font-bold p-4">
                        <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xl px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ready to pickup</button>
                    </div>
                </div>
                <div class="p-6 overflow-hidden w-auto h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center md:ml-0.5">  
                    <div class="mt-5 text-7xl font-bold ">123</div>
                    <div class="text-xl font-bold p-4">
                        <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xl px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Claimed</button>
                    </div>
                </div>
            </div>
        </template>

        <div class="grid grid-cols-1 xl:grid-cols-2 dark:text-white">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-2">
                <PieChart/>
            </div>
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-2 md:ml-0.5">
                <BarChart/>
            </div>
        </div>
    </Registrar>
</template>

