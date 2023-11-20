<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Search from '@/Components/Search.vue'
import { onMounted, ref, watch, useAttrs } from 'vue';
import axios from 'axios';

const request = ref(null);
const filter = ref(6);
const attrs = useAttrs();
const rqst = ref([]);
const docRequest = ref(null);
const dtls = ref([]);
const Open = ref(false);
const showModal = ref(false);


const getdocRequest = async () => {
  try {
    const response = await axios.get('/getRequest'); // Replace with your actual endpoint
    request.value = response.data.data;
    rqst.value = response.data.request;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

const changeDocs = (i) => {
    rqst.value.forEach((value, index) => {
        if(index == i) {
            docRequest.value = value;
        }
    });
    request.value.forEach((value, index) => {
        if(index == i) {
            dtls.value = value;
        }
    });
}
const closeModal = () => {
    showModal.value = false;
}
watch(filter, (after, before) => {
    if (after === '6') {
        getdocRequest();
    }
    else{
    axios.get(route('filter', {
        filters: after,
        student: attrs.auth.user.student_number
    })).then((response) => {
        request.value = response.data.details;
        rqst.value = response.data.request
    });
    }
})

onMounted(() => {
    getdocRequest();
});
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Requests
                </h2>
            <div class="flex justify-end items-center space-x-1">
                <div class="flex justify-end" >
                    <select v-model="filter" id="countries" class="w-32 h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="6">Filters</option>
                        <option value="1">Completed</option>
                        <option value="0">Pending</option>
                        <option value="4">Paid</option>
                        <option value="2">Claimed</option>
                        <option value="3">Rejected</option>
                        <option value="5">Approved</option>
                        
                    </select>
                </div>
                <Search/>
            </div>
            </div>
        </template>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="grid grid-cols-5">
                        <th scope="col" class="px-3 py-3 text-center">
                            Reference Number
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Total Amount
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            OR Number
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
                    <tr v-for="(item, index) in request" :key="id" class="grid grid-cols-5 border-b-2 border-zinc-100 dark:border-zinc-100">
                        <td scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            {{item.reference_no}}  
                        </td>
                        <td scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            {{item.total_amount}}
                        </td>
                        <td scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            {{item.OR_no}}
                        </td>
                        <td v-if="item.req_status == 0" scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            Pending
                        </td>
                        <td v-if="item.req_status == 1" scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            Completed
                        </td>
                        <td v-if="item.req_status == 2" scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            Claimed
                        </td>
                        <td v-if="item.req_status == 3" scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            Rejected
                        </td>
                        <td v-if="item.req_status == 4" scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            Paid
                        </td>
                        <td v-if="item.req_status == 5" scope="col" class="px-3 py-3 text-center font-semibold text-black dark:text-white">
                            Approved
                        </td>
                        <td scope="col" class="px-3 py-3 flex justify-center">
                            <div class="flex justify-end items-center" >
                                <label @click="changeDocs(index)" for="tw-modal"  class="flex justify-center focus:outline-none max-md:w-11 text-white bg-mmsu-g hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    View
                                </label>
                                <input type="checkbox" id="tw-modal" class="z-40 peer fixed appearance-none opacity-0">
                                <label for="tw-modal" class=" z-40 pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
                                    <div class=" scale-90 overflow-y-auto overscroll-contain bg-white rounded-md p-4 text-black shadow-2xl transition border-2 dark:bg-gray-100">
                                        <!-- {{ index }} -->
                                        <div v-if="ShowModal" class="flex justify-end">
                                            <button @click="closeModal" class=" bg-black"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-md:w-6 max-md:h-6 w-8 h-8 flex justify-start">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-center font-semibold text-black" >
                                            <h2>Request Details</h2>
                                        </div>
                                        <div class="grid grid-cols-3 mt-10">
                                            <div class="text-left">
                                                Date: {{ dtls.created_at }}
                                            </div>
                                            <div class="text left">
                                                Student #: {{ dtls.stud_no }}
                                            </div>
                                            <div class="text-left">
                                                Degree: {{ dtls.degree }}
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 mt-5">
                                            <div class="text-left">
                                                Name: {{ dtls.name }}
                                            </div>
                                            <div class="text left">
                                                Email: {{ dtls.email }}
                                            </div>
                                            <div class="text-left">
                                                Contact #: {{ dtls.cont_no }}
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <div class="text-left">
                                                Remarks: {{ dtls.remarks }}
                                            </div>
                                        </div>
                                        <!-- {{ index }} -->
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
                                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-gray">
                                                    {{doc.name}}  
                                                </div>
                                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-gray">
                                                    {{doc.price}}
                                                </div>
                                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-gray">
                                                    {{doc.copies}}
                                                </div>
                                                <div scope="col" class="px-3 py-3 text-center font-normal text-black dark:text-gray">
                                                    {{doc.purpose}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label> 
                            </div>  
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
