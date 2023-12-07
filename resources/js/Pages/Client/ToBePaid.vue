<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Search from '@/Components/Search.vue'
import { onMounted, ref, watch, useAttrs, computed } from 'vue';
import axios from 'axios';
import BarcodeGenerator from '@/Components/BarcodeGenerator.vue';
import moment from 'moment';

const request = ref([]);
const rqst = ref([]);
const docRequest = ref(null);
const dtls = ref([]);
const showModal = ref(false);
const barcodeValue = ref(''); 
const noResults = ref(true);

const formatDate = (dateString) => {
  return moment(dateString).format('YYYY-MM-DD');
};

const getdocRequest = async () => {
  try {
    const response = await axios.get('/get-Payment');
    request.value = response.data.data;
    rqst.value = response.data.request;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

const performSearch = (searchQuery) => {
    axios.get('/approve/search', {
        params: {
            search: searchQuery,
        },
    })
    .then(response => {
        console.log(response.data);
        request.value = response.data;

        noResults.value = response.data.length === 0;
    })
    .catch(error => {
        console.error('Error fetching request:', error);
    });
};

const changeDocs = (i) => {
    showModal.value = true;
    rqst.value.forEach((value, index) => {
        if(index == i) {
            docRequest.value = value;
        }
    });
    request.value.forEach((value, index) => {
        if(index == i) {
            dtls.value = value;
            barcodeValue.value = value.reference_no;
        }
    });
}

onMounted(() => {
    getdocRequest();
});
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    To-Be-Paid
                </h2>
                <div class="flex justify-end items-center space-x-1">
                    <Search @search="performSearch"/>
                </div>
            </div>
        </template>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="grid grid-cols-4 max-md:grid-cols-3">
                        <th scope="col" class="px-3 py-3 text-center">
                            Reference Number
                        </th>
                        <th scope="col" class="px-3 py-3 text-center max-md:hidden">
                            Total Amount
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Status
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Action
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in request" :key="id" class="grid grid-cols-4 max-md:grid-cols-3 border-b-2 border-zinc-100 dark:border-gray-500">
                        <td scope="col" class="px-3 py-3 text-center font-sm text-black dark:text-white">
                            {{item.reference_no}}  
                        </td>
                        <td scope="col" class="px-3 py-3 text-center font-sm text-black dark:text-white max-md:hidden">
                            {{item.total_amount}}
                        </td>
                        <td v-if="item.req_status == 1" scope="col" class="px-3 py-3 text-center font-sm text-black dark:text-white">
                            Approved
                            <div class="flex justify-center">
                                <!-- <BarcodeGenerator
                                    :value="barcodeValue"
                                    :format="'CODE39'"
                                    :lineColor="'black'"
                                    :width="1"
                                    :height="20"
                                    :elementTag="'img'"
                                    /> -->
                            </div>
                        </td>
                        <td scope="col" class="px-3 py-3 flex justify-center">
                            <div class="flex items-center justify-center" >
                                <label @click="changeDocs(index)" class="flex justify-center focus:outline-none max-md:w-11 text-white bg-mmsu-g hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    View
                                </label> 
                            </div>                                          
                        </td>
                    </tr>
                </tbody>
            </table>  
            <div v-if="showModal" class="backdrop-blur-sm flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-6xl max-h-full">
                    <div class="p-6 relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Payment
                            </h3>
                            <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div class="">
                            <div class="grid text-left md:grid-cols-3 md:gap-6 dark:text-white-400">
                                <div class="text-left flex mt-2 space-x-2">
                                    <p class="font-semibold">Date:</p> <p>{{ formatDate(dtls.created_at) }}</p>
                                </div>
                                <div class="text left flex mt-2 space-x-2">
                                    <p class="font-semibold">Student #:</p> <p>{{ dtls.stud_no }}</p>
                                </div>
                                <div class="text-left flex mt-2 space-x-2">
                                    <p class="font-semibold">Degree:</p> <p>{{ dtls.degree }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-3 md:gap-6 ">
                            <div class="text-left flex mt-2 space-x-2">
                                <p class="font-semibold">Name:</p> <p>{{ dtls.name }}</p>
                            </div>
                            <div class="text left flex mt-2 space-x-2">
                                <p class="font-semibold">Email:</p> <p>{{ dtls.email }}</p>
                            </div>
                            <div class="text-left flex mt-2 space-x-2">
                                <p class="font-semibold">Contact #:</p> <p>{{ dtls.cont_no }}</p>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-3 md:gap-6">
                            <div class="text-left flex mt-2 space-x-2">
                                <p class="font-semibold">Remarks:</p> <p>{{ dtls.remarks }}</p>
                            </div>
                        </div>
                        <div class="border-b-4 dark:border-slate-400">
                            <div class="grid grid-cols-4 mt-5 border-y-4 border-x-4 dark:border-slate-400">
                                <div scope="col" class="px-3 py-3 text-center font-semibold">
                                    Document
                                </div>
                                <div scope="col" class="px-3 py-3 text-center font-semibold">
                                    Total Price
                                </div>
                                <div scope="col" class="px-3 py-3 text-center font-semibold">
                                    Copies
                                </div>
                                <div scope="col" class="px-3 py-3 text-center font-semibold">
                                    Purpose
                                </div>
                            </div>
                            <div v-for="doc in docRequest" class="grid grid-cols-4 border-x-4 dark:border-slate-400">
                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-white">
                                    {{doc.name}}  
                                </div>
                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-white">
                                    {{doc.price}}
                                </div>
                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-white">
                                    {{doc.copies}}
                                </div>
                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-white">
                                    {{doc.purpose}}
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="flex justify-center">
                                <BarcodeGenerator
                                    :value="barcodeValue"
                                    :format="'CODE39'"
                                    :lineColor="'black'"
                                    :width="1"
                                    :height="20"
                                    :elementTag="'img'"
                                    />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="noResults && request.length === 0">
            <label class="flex justify-center font-semibold text-md mt-4 dark:text-gray-400"> No Result Found!</label>
        </div>
    </AuthenticatedLayout>
</template>