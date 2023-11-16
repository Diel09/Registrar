<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Filter from '@/Components/Filter.vue'
import Search from '@/Components/Search.vue'
import { onMounted, ref } from 'vue';
import axios from 'axios';
import InputForm from '@/Components/InputForm.vue';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';

const docReq = ref(null);
// const document = ref(props.document);

// Define a method to make a GET request
const getRequest = async () => {
  try {
    const response = await axios.get('/getRequest'); // Replace with your actual endpoint
    docReq.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

// Trigger the GET request when the component is mounted
onMounted(() => {
    getRequest();
});

defineProps({
    'title': String,
    'name': String
})

</script>

<template>
    <Registrar title="Registrar" :username="name">
        <template #header>
            <div class="flex items-center justify-end space-x-1">
                <Filter/><Search/>
            </div>
        </template>

        <div class= "p-6 mb-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <!-- v-for="item in responseData" -->
            <!-- <div class="grid grid-cols-2" >
                <div class="">Name:</div><div>{{item.name}} </div>
                <div>Student No: </div><div>{{item.stud_no}}</div>
                <div>Document Type:</div><div></div>
                <div>No. Copies:</div><div></div>
                <div>Remarks</div><div>{{item.remarks}}</div>
            </div> -->
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-sm font-light text-center">
                                    <thead class="font-medium border-b dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-3 py-4">Name</th>
                                            <th scope="col" class="px-3 py-4">Reference number</th>
                                            <th scope="col" class="px-3 py-4">Remark</th>
                                            <th scope="col" class="px-3 py-4">Date</th>
                                            <th scope="col" class="px-3 py-4"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in docReq">
                                            <td class="px-3 py-4 font-medium">
                                                {{item.name}}
                                            </td>
                                            <td class="px-3 py-4">
                                                {{item.reference_no}}                                          
                                            </td>
                                            <td class="px-3 py-4">
                                                {{item.remarks}}                                          
                                            </td>
                                            <td class="px-3 py-4">
                                                {{item.created_at}}                                          
                                            </td>
                                            <td class="px-3 py-4">
                                                    <div class="flex items-center justify-end" >
                                                        <label for="tw-modal" class="text-white bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700 w-28 h-14 flex justify-center items-center font-semibold">
                                                            View
                                                        </label>
                                                        <input type="checkbox" id="tw-modal" class="fixed z-40 opacity-0 appearance-none peer">
                                                        <label  for="tw-modal" class=" z-40 pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
                                                        <div class="p-6 overflow-y-auto text-black transition scale-90 bg-white border-2 rounded-md shadow-2xl overscroll-contain" >
                                                            <div class="font-semibold text-center text-black" >
                                                                <h2>Request Details</h2>
                                                            </div>
                                                            <div>
                                                                <div class="grid text-left md:grid-cols-3 md:gap-6 dark:text-white-400">
                                                                    <div class="mt-5">
                                                                        <div>Date: {{ item.created_at}}</div>
                                                                    </div>
                                                                    <div class="mt-5 text-left">
                                                                        <div>Student Number: {{ item.stud_no }}</div>
                                                                    </div>
                                                                    <div class="mt-5 text-left">
                                                                        <div>Name: {{ item.name }}</div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="grid md:grid-cols-3 md:gap-6 ">
                                                                <div class="mt-5 text-left">
                                                                    <div>Email: {{ item.email }}</div>
                                                                </div>
                                                                <div class="mt-5 text-left">
                                                                    <div>College: {{ item.college }}</div>
                                                                </div>
                                                                <div class="mt-5 text-left">
                                                                    <div>Degree: {{ item.degree }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="grid md:grid-cols-3 md:gap-6">
                                                                <div class="mt-5 text-left">
                                                                    <div>Remarks: {{ item.remarks }}</div>
                                                                </div>
                                                                <div class="mt-5 text-left">
                                                                    <div>Total Amount: {{ item.total_amount }}</div>
                                                                </div>
                                                                <div class="mt-5 text-left">
                                                                    <div>Reference Number: {{ item.reference_no }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="grid md:grid-cols-3 md:gap-6">
                                                                <div class="mt-5 text-left">
                                                                    <div>OR Number: {{ item.OR_no }}</div>
                                                                </div>
                                                                <div class="mt-5 text-left">
                                                                    <div>Contact Number: {{ item.cont_no }}</div>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                                                                <div class="flex flex-col">
                                                                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                                            <div class="overflow-hidden">
                                                                                <table class="min-w-full text-sm font-light text-center">
                                                                                    <thead class="font-medium border-b dark:border-neutral-500">
                                                                                        <tr>
                                                                                            <th scope="col" class="px-3 py-4">Document</th>
                                                                                            <th scope="col" class="px-3 py-4">Copies</th>
                                                                                            <th scope="col" class="px-3 py-4">Purpose</th>
                                                                                            <th scope="col" class="px-3 py-4">Price</th>
                                                                                            <th scope="col" class="px-3 py-4"></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="item in docReq">
                                                                                            <td class="px-3 py-4 font-medium">
                                                                                                {{item.id}}
                                                                                            </td>
                                                                                            <td class="px-3 py-4">
                                                                                                {{item.reference_no}}                                          
                                                                                            </td>
                                                                                            <td class="px-3 py-4">
                                                                                                {{item.remarks}}                                          
                                                                                            </td>
                                                                                            <td class="px-3 py-4">
                                                                                                {{item.price}}                                          
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- <div class="flex items-center justify-end" >
                    <label for="tw-modal" class="text-white bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700 w-28 h-14 flex justify-center items-center font-semibold">
                        View
                    </label>
                    <input type="checkbox" id="tw-modal" class="fixed z-40 opacity-0 appearance-none peer">
                    <label  for="tw-modal" class=" z-40 pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
                    <div class="p-6 overflow-y-auto text-black transition scale-90 bg-white border-2 rounded-md shadow-2xl overscroll-contain" >
                        <div class="font-semibold text-center text-black" >
                            <h2>Request Details</h2>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Name:</div>
                            <div class="flex justify-start font-semibold text-black">{{item.name}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Student Number:</div>
                            <div class="font-semibold text-black">{{item.stud_no}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Document Type:</div> 
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">No. of Copies:</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Email:</div>
                            <div class="font-semibold text-black">{{item.email}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Degree:</div>
                            <div class="font-semibold text-black">{{item.degree}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">College:</div>
                            <div class="font-semibold text-black">{{item.college}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Contact #:</div>
                            <div class="font-semibold text-black">{{item.cont_no}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Total Ammount:</div>
                            <div class="font-semibold text-black">{{item.total_amount}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Status:</div>
                            <div class="font-semibold text-black">{{item.req_status}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Reference #:</div>
                            <div class="font-semibold text-black">{{item.reference_no}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">OR number:</div>
                            <div class="font-semibold text-black">{{item.OR_no}}</div>
                        </div>
                        <div class="grid grid-cols-2 border-black mt-7">
                            <div class="flex justify-center">Remarks:</div>
                            <div class="font-semibold text-black">{{item.remarks}}</div>
                        </div>
                        <div class="flex items-center justify-end ">
                            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Done</button>
                        </div>
                    </div>
                </label> 
            </div>   -->
        </div>
    </Registrar>
</template>