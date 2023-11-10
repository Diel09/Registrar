<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Filter from '@/Components/Filter.vue'
import Search from '@/Components/Search.vue'
import { onMounted, ref } from 'vue';
import axios from 'axios';

const responseData = ref(null);
// const document = ref(props.document);

// Define a method to make a GET request
const fetchData = async () => {
  try {
    const response = await axios.get('/getRequest'); // Replace with your actual endpoint
    responseData.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

// Trigger the GET request when the component is mounted
onMounted(() => {
  fetchData();
});

defineProps({
    'title': String,
    'name': String
})
</script>

<template>
    <Registrar title="Registrar" :username="name">
        <template #header>
            <div class="flex justify-end items-center space-x-1">
                <Filter/><Search/>
            </div>
        </template>

        <div class= "p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 grid grid-cols-2 mb-2" v-for="item in responseData">
            <div class="grid grid-cols-2" >
                <div class="">Name:</div><div>{{item.name}} </div>
                <div>Student No: </div><div>{{item.stud_no}}</div>
                <div>Document Type:</div><div></div>
                <div>No. Copies:</div><div></div>
                <div>Remarks</div><div>{{item.remarks}}</div>
            </div>
            <div class="flex justify-end items-center" >
                    <label for="tw-modal" class="text-white bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700 w-28 h-14 flex justify-center items-center font-semibold">
                        View
                    </label>
                    <input type="checkbox" id="tw-modal" class="z-40 peer fixed appearance-none opacity-0">
                    <label  for="tw-modal" class=" z-40 pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
                    <div class=" scale-90 overflow-y-auto overscroll-contain bg-white rounded-md p-6 text-black shadow-2xl transition border-2" >
                        <div class="text-center font-semibold text-black" >
                            <h2>Request Details</h2>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Name:</div>
                            <div class="text-black font-semibold flex justify-start">{{item.name}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Student Number:</div>
                            <div class="text-black font-semibold">{{item.stud_no}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Document Type:</div> 
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">No. of Copies:</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Email:</div>
                            <div class="text-black font-semibold">{{item.email}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Degree:</div>
                            <div class="text-black font-semibold">{{item.degree}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">College:</div>
                            <div class="text-black font-semibold">{{item.college}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Contact #:</div>
                            <div class="text-black font-semibold">{{item.cont_no}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Total Ammount:</div>
                            <div class="text-black font-semibold">{{item.total_amount}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Status:</div>
                            <div class="text-black font-semibold">{{item.req_status}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Reference #:</div>
                            <div class="text-black font-semibold">{{item.reference_no}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">OR number:</div>
                            <div class="text-black font-semibold">{{item.OR_no}}</div>
                        </div>
                        <div class="mt-7  border-black grid grid-cols-2">
                            <div class="flex justify-center">Remarks:</div>
                            <div class="text-black font-semibold">{{item.remarks}}</div>
                        </div>
                        <div class="flex justify-end items-center ">
                            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Done</button>
                        </div>
                    </div>
                </label> 
            </div>  
        </div>
    </Registrar>
</template>