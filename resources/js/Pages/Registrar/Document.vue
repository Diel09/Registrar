<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Forms from '@/Components/DocForm.vue'
import { onMounted, ref } from 'vue';
import axios from 'axios';
import Inputs from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import Toastr from '@/Components/Toastr.vue'

// Create a variable to store the retrieved data
const responseData = ref([]);
const showModal = ref(false);
const showDelete = ref(false);
const showEdit = ref(false);
const currentDocument = ref(null);
const editDocument = ref(null);
const deleteDocument = ref(null);
const showSuccessToastr =ref(false);
const showErrorToastr = ref(false);
const Message = ref(null);

// const document = ref(props.document);
    const fetchData = async () => {
        try {
            const response = await axios.get('/getDocTypes'); // Replace with your actual endpoint
            responseData.value = response.data;
            console.log(responseData.value);
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
        'name': String,
    });

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

    const editDocs = (id) => {
        showEdit.value = true;
        responseData.value.forEach((value, index) => {
            if(index == id) {
                editDocument.value = value;
            }
        });
        currentDocument.value = id;
    };

    const submitData = () => {
        axios.post('/document/edit', editDocument.value).then(() => {
            toastr('success', 'Document edited successfully.');
            showEdit.value = false;
        });
    };

    const deleteDocs = (id) => {
        responseData.value.forEach((value, index) => {
            if(index == id) {
                deleteDocument.value = value;
            }
        });
        showDelete.value = true;
    };

    const deleteConfirmation = (confirmed) => {
        if(confirmed){
            axios.post('/deleteDocs', deleteDocument.value)
            .then(({data})=>{
                if(data ){
                    fetchData();
                    toastr('success', 'Document deleted successfully.');
                    showDelete.value = false;
                    showModal.value = false;
                }else{
                    showDelete.value = false;
                    toastr('error', 'Document cannot be deleted.');
                }
            })
        }else{
            showDelete.value = false;
        }
    };
</script>

<template>
    <Registrar title="Registrar" :username="name">
        <template #header>
            <Toastr :success="showSuccessToastr" @remove="removeToastr" :error="showErrorToastr" :message="Message"/>  
            <div class="grid grid-cols-2 p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-gray-700 md:grid">
                <div class="flex items-center font-semibold dark:bg-gray-700">
                    Documents
                </div>
                <div class="">
                    <Forms :fetchData="fetchData"/>
                </div>
            </div>
        </template>
            <div class="overflow-hidden relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="min-w-full text-sm font-light text-center">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-4 text-center indent-4">Document Types</th>
                            <th scope="col" class="px-3 py-4">Price</th>
                            <th scope="col" class="px-3 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in responseData" class="border-b-2 border-slate-100 dark:border-gray-700">
                            <td class="py-2 font-normal text-center indent-4">
                                {{item.name}}
                            </td>
                            <td class="py-2">
                                {{item.price}}
                            </td>
                            <td class="py-2">
                                <label type="button" @click="editDocs(index)" class="text-white bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700">Edit</label>
                                <div v-if="showEdit" class="backdrop-blur-sm flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-96 max-w-6xl max-h-full">
                                        <!-- Modal content -->
                                        <div class=" relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold dark:text-white text-black">
                                                    Edit Document
                                                </h3>
                                                <button @click="showEdit = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="">
                                                <form @submit.prevent="submitData" class="">
                                                    <datalist id="documentSuggestions">
                                                        <option v-for="document in documentSuggestions" :key="document.id" :value="document.description"></option>
                                                    </datalist>
                                                    <div>
                                                        <div class="border-black mt-7 ml-5">
                                                            <Label value="Document" class="mb-2 text-left"/>
                                                            <div class="relative">
                                                                <div class="absolute inset-y-2.5 flex left-1 items-left pl-3 pointer-events-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 indent-2 ml-3">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                                    </svg>
                                                                </div>
                                                                <Inputs class=" rounded-md indent-4 w-80 py-1"
                                                                    v-model="editDocument.name"
                                                                    :type="type"
                                                                    required
                                                                    placeholder="Document"
                                                                    @input="$emit('update:modelValue', $event.target.value)"
                                                                    ref="input"
                                                                    list="documentSuggestions"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="mt-3 ml-5 mb-2">
                                                            <Label value="Price" class="mb-2 text-left"/>  
                                                            <div class="relative">
                                                                <div class="absolute inset-y-2.5 left-1 flex items-left pl-3 pointer-events-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-3">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                </div>
                                                                <Inputs type="text" required name="price" placeholder="Price" v-model="editDocument.price" class="text-gray-500 rounded-md indent-4 w-80"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="flex items-end justify-end ">
                                                            <button type="submit" @click="uploadData" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <label type="button" @click="deleteDocs(index)" class="text-white bg-red-800 hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-red-800 dark:hover:bg-red-600 dark:focus:ring-red-500 dark:border-gray-700">Delete</label>
                                <div v-if="showDelete" class="backdrop-blur-sm flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-fit max-w-6xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="p-6 relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">
                                                    Delete
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
                                                <div class="text-start md:grid-cols-3 md:gap-6 dark:text-white-400 mt-2 mb-2 font-medium">
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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </Registrar>
</template>