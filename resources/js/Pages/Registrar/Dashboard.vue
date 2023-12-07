<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import PieChart from '@/Components/Chart/PieChart.vue'
import BarChart from '@/Components/Chart/LineChart.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'

defineProps({
    'title': String,
    'name': String
})
import { ref, onMounted } from 'vue';

const requestData = ref(0);
const requestCount = ref([]);
const ProcessingData = ref(0);
const ProcessingCount = ref([]);
const CompletedData = ref(0);
const CompletedCount = ref([]);

const fetchItemRequestDetails = async () => {
  const response = await axios.get('/getItemRequestDetails'); // Replace with your actual endpoint
  requestData.value = response.data.data;
  requestCount.value = response.data.request;
};

const fetchItemProcessing = async () => {
  const response = await axios.get('/getItemProcessing'); // Replace with your actual endpoint
  ProcessingData.value = response.data.data;
  ProcessingCount.value = response.data.request;
};

const fetchItemCompleted = async () => {
  const response = await axios.get('/getItemCompleted'); // Replace with your actual endpoint
  CompletedData.value = response.data.data;
  CompletedCount.value = response.data.request;
};

onMounted(() => {
    fetchItemRequestDetails();
    fetchItemProcessing();
    fetchItemCompleted();
});
</script>

<template>
    <Registrar title="Registrar" :username="name">
        <template #header>
            <div class="grid justify-center grid-cols-1 xl:grid-cols-3 ">
                <div class="w-auto p-6 mt-2 overflow-hidden text-center bg-white rounded-md shadow-md h-60 dark:bg-dark-eval-1 ">
                    <div class="mt-5 font-bold text-7xl">
                        <div>
                                <h1>{{ requestData }}</h1>
                        </div>
                        </div>
                    <div class="p-4 text-xl font-bold">
                       <button type="button">
                        <SidebarLink class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xl px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition ease-in-out delay-0 hover:-translate-y-1 hover:scale-110 duration-300 ..."
                            title="For Approval"
                            :href="route('TobeApprove')"
                            :active="route().current('TobeApprove')"
                        >
                            <template #icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                </svg>
                            </template>
                        </SidebarLink>
                       </button>
                    
                    </div>
                </div>
                <div class="p-6 overflow-hidden w-auto h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center md:ml-0.5 ">
                    <div class="mt-5 font-bold text-7xl">
                        <div>
                                <h1>{{ ProcessingData }}</h1>
                        </div>
                    </div>
                    <div class="p-4 text-xl font-bold">
                        <button type="button">
                        <SidebarLink class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xl px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition ease-in-out delay-0 hover:-translate-y-1 hover:scale-110 duration-300 ..."
                            title="For Processing"
                            :href="route('Processing')"
                            :active="route().current('Processing')"
                        >
                            <template #icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                </svg>
                            </template>
                        </SidebarLink>
                       </button>                    
                    </div>
                </div>
                <div class="p-6 overflow-hidden w-auto h-60 bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-2 text-center md:ml-0.5">  
                    <div class="mt-5 font-bold text-7xl ">
                        <div>
                                <h1>{{ CompletedData }}</h1>
                        </div>
                    </div>
                    <div class="p-4 text-xl font-bold">
                        <button type="button">
                        <SidebarLink class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xl px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition ease-in-out delay-0 hover:-translate-y-1 hover:scale-110 duration-300 ..."
                            title="Ready to Pickup"
                            :href="route('Ready')"
                            :active="route().current('Ready')"
                        >
                            <template #icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                </svg>
                            </template>
                        </SidebarLink>
                       </button> 
                    </div>
                </div>
            </div>
        </template>

        <div class="grid grid-cols-1 xl:grid-cols-2 dark:text-white">
            <div class="p-6 mb-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <PieChart/>
            </div>
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-2 md:ml-0.5">
                <BarChart/>
            </div>
        </div>
    </Registrar>
</template>

