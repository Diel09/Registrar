<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Search from '@/Components/Search.vue'
import { onMounted, ref} from 'vue';
import axios from 'axios';
import moment from 'moment';
import Toastr from '@/Components/Toastr.vue';

const rqst = ref([]);
const currentRequest = ref(null);
const docReq = ref('');
const dtls = ref([]);
const showModal = ref(false);
const noResults = ref(true);
const showDelete = ref(false);
const showSuccessToastr =ref(false);
const showErrorToastr = ref(false);
const Message = ref(null);

// const document = ref(props.document);

// Define a method to make a GET request
const getRequest = async () => {
  try {
    const response = await axios.get('/get-Requests'); // Replace with your actual endpoint
    docReq.value = response.data.data;
    rqst.value = response.data.request;
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

const toastr = async (type, message) => {
        if (type === 'success') {
        showSuccessToastr.value = true;
        } else if (type === 'error') {
            showErrorToastr.value = true;
        }
        Message.value = message;

        setTimeout(() => {
            removeToastr();
        }, 4000);
    }

    const removeToastr = async() => {
        showSuccessToastr.value = false;
        showErrorToastr.value = false
    }

const changeDocs = (i) => {
    showModal.value = true;
    rqst.value.forEach((value, index) => {
        if(index == i) {
            currentRequest.value = value;
        }
    });
    docReq.value.forEach((value, index) => {
        if(index == i) {
            dtls.value = value;
        }
    });
};
const formatdate = (dateString) => {
    return moment(dateString).format('YYYY-MM-DD');
}

const deleteRequest = (id) => {
    showDelete.value = true;
    currentRequest.value = id;
};


const deleteConfirmation = (confirmed) => {
    showDelete.value = false;
    if(confirmed){
        const id = currentRequest.value;
        axios.post('/deleteRequest',{id: id})
        .then(({data})=>{
            if(data){
                toastr('success', 'Document deleted successfully.');
                showDelete.value = true;
                showModal.value = false;
                getRequest();                                                                
            }else{
                alert('error');
            }
        })
    }else{
        showDelete.value = false;
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
        docReq.value = response.data;

        noResults.value = response.data.length === 0;
    })
    .catch(error => {
        console.error('Error fetching request:', error);
        noResults.value = true;
    });
};
        
</script>

<template>
    <Toastr :success="showSuccessToastr" @remove="removeToastr" :error="showErrorToastr" :message="Message"/> 
    <Registrar title="Registrar" :username="name">
        <template #header>
            <div class="flex items-center justify-end space-x-1">
                <Search @search="performSearch"/>
            </div>
        </template>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="grid grid-cols-5">
                                <th scope="col" class="px-3 py-3 text-center">
                                    Name
                                </th>
                                <th scope="col" class="px-3 py-3 text-center">
                                    Reference Number
                                </th>
                                <th scope="col" class="px-3 py-3 text-center">
                                    Remarks
                                </th>
                                <th scope="col" class="px-3 py-3 text-center">
                                    Date
                                </th>
                                <th scope="col" class="px-3 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in docReq" :key="id" class="grid grid-cols-5 border-b-2 border-zinc-100 dark:border-gray-500">
                                <td scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                    {{item.name}}  
                                </td>
                                <td scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                    {{item.reference_no}}
                                </td>
                                <td scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                    {{item.remarks}}
                                </td>
                                <td scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                    {{formatdate(item.created_at)}}
                                </td>
                                <td class="px-3 py-4">                                               
                                    <div class="flex items-center justify-center" >
                                        <label @click="deleteRequest(item.id)" class="flex justify-center focus:outline-none max-md:w-11 text-white bg-red-800 hover:bg-red-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-red-900 dark:hover:bg-red-800 dark:focus:ring-red-900">
                                            Delete
                                        </label>                                 
                                        <div v-if="showDelete" class="backdrop-blur-sm flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative w-fit max-w-6xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="p-6 relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">
                                                            Approve
                                                        </h3>
                                                        <button @click="showDelete = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="w-96">
                                                        <div class="md:grid-cols-3 md:gap-6 dark:text-white-400 mt-2 mb-2 font-medium">
                                                            Are you sure to submit?
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <button @click="deleteConfirmation(true)" class="mt-3 text-white bg-red-800 hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-900 dark:hover:bg-red-800 dark:focus:ring-red-900 dark:border-gray-700">OK</button>
                                                            <button @click="deleteConfirmation(false)" class="mt-3 text-white bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                            <!-- Modal content -->
                            <div class="p-6 relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Request Details
                                    </h3>
                                    <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="">
                                    <div class="grid text-left md:grid-cols-3 md:gap-6 dark:text-white-400">
                                        <div class="mt-5">
                                            <div>Date: {{formatdate(dtls.created_at)}}</div>
                                        </div>
                                        <div class="mt-5 text-left">
                                            <div>Student Number: {{ dtls.stud_no }}</div>
                                        </div>
                                    
                                        <div class="mt-5 text-left">
                                            <div>Name: {{ dtls.name }}</div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="grid md:grid-cols-3 md:gap-6 ">
                                    <div class="mt-5 text-left">
                                        <div>Email: {{ dtls.email }}</div>
                                    </div>
                                    <div class="mt-5 text-left">                                                   
                                        <div>
                                            <div v-if="dtls.college == 1">College: College of Arts and Sciences
                                            </div>
                                            <div v-if="dtls.college == 2">College: College of Agriculture Food and Sustainable Development 
                                            </div>
                                            <div v-if="dtls.college == 3">College: College of Aquatic Science and Applied Technology
                                            </div>
                                            <div v-if="dtls.college == 4">College: College of Arts and Sciences
                                            </div>
                                            <div v-if="dtls.college == 5">College: College of Business, Entrepreneurship and Accountancy
                                            </div>
                                            <div v-if="dtls.college == 6">College: College of Engeneering
                                            </div>
                                            <div v-if="dtls.college == 7">College: College of Health Sciences
                                            </div>
                                            <div v-if="dtls.college == 8">College: College of Insdustrial Technology 
                                            </div>
                                            <div v-if="dtls.college == 9">College: College of Teacher Education
                                            </div>
                                            <div v-if="dtls.college == 10">College: College of Law
                                            </div>
                                            <div v-if="dtls.college == 11">College: College of Medicine
                                            </div>
                                            <div v-if="dtls.college == 12">College: College of Computing and Information Sciences
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-left">
                                        <div>Degree: {{ dtls.degree }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-3 md:gap-6">
                                    <div class="mt-5 text-left">
                                        <div>Remarks: {{ dtls.remarks }}</div>
                                    </div>
                                    <div class="mt-5 text-left">
                                        <div>Total Amount: {{ dtls.total_amount }}</div>
                                    </div>
                                    <div class="mt-5 text-left">
                                        <div>Reference Number: {{ dtls.reference_no }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-3 md:gap-6">
                                    <div class="mt-5 text-left">
                                        <div>OR Number: {{ dtls.OR_no }}</div>
                                    </div>
                                    <div class="mt-5 text-left">
                                        <div>Contact Number: {{ dtls.cont_no }}</div>
                                    </div>
                                    
                                </div>
                                
                                <div class="border-b-4 dark:border-slate-400">
                                    <div class="grid grid-cols-4 mt-5 border-y-4 border-x-4 dark:border-slate-400">
                                        <div scope="col" class="px-3 py-3 font-semibold text-center dark:text-white">
                                            Document
                                        </div>
                                        <div scope="col" class="px-3 py-3 font-semibold text-center dark:text-white">
                                            Total Price
                                        </div>
                                        <div scope="col" class="px-3 py-3 font-semibold text-center dark:text-white">
                                            Copies
                                        </div>
                                        <div scope="col" class="px-3 py-3 font-semibold text-center dark:text-white">
                                            Purpose
                                        </div>
                                    </div>
                                    <div v-for="doc in currentRequest" class="grid grid-cols-4 border-x-4 dark:border-slate-400">
                                        <div scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                            {{doc.name}}  
                                        </div>
                                        <div scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                            {{doc.price}}
                                        </div>
                                        <div scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                            {{doc.copies}}
                                        </div>
                                        <div scope="col" class="px-3 py-3 font-normal text-center text-black dark:text-white">
                                            {{doc.purpose}}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end">                                            
                                </div>
                            </div>
                        </div>
                    </div>
    
        </div>
        <div v-if="noResults && docReq.length === 0">
            <label for="" class="flex justify-center font-semibold mt-4 text-md dark:text-gray-400">No Result Found!</label>
        </div>
    </Registrar>
</template>