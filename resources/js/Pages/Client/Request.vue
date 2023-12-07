<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import InputForm from '@/Components/InputForm.vue'
import Toastr from '@/Components/Toastr.vue'
import { defineEmits } from 'vue';
import axios from 'axios'; // Import Axios

export default {
    data() {
        return {
            form: {
                date: new Date().toISOString().substr(0, 10),
                studno: this.details.student_number,
                degree: this.details.degree,
                name:  this.details.surname + ' ' + this.details.firstname + '. ' + this.details.middlename[0],
                contact: null,
                purpose: null,
                remarks: null,
                graduate: null,
                notgrad: null,
                notenrolled: null,
                enrolled: null,
                email: this.details.email,
                college: this.details.college_id
            },
            textType: 'text',
            input: null,
            docTypes: [],
            selectedDocuments: [],
            selects: { 
                name: null, 
                copies: null,
                purpose: null
             },
             showSuccessToastr: false,
             showErrorToastr: false,
             Message: null,
        }
    }, 
    props: {
        modelValue: {
        type: [String, Number],
        required: true,
    },
        label: String,
        type: String,
        details: {
            type: Object,
            required: true,
        },
    },
    components: {AuthenticatedLayout, InputForm, Toastr},
    methods: {
        fetchData(){
            axios.get('/getDocTypes').then((response) => { 
                this.docTypes = response.data;
            });//Getting the data from getDocTypes
        },
        toastr(type, message) {
            if (type === 'success') {
                this.showSuccessToastr = true;
            } else if (type === 'error') {
                this.showErrorToastr = true;
            }
            this.Message = message;

            setTimeout(() => {
                this.removeToastr();
            }, 4000);
        },
        async saveData() {
            if (this.selectedDocuments.length === 0) {
                this.toastr('error', 'Please add at least one document.');
            }

            if (this.form.contact === null) {
                this.toastr('error', 'Please input your number');
            }

            // Add more conditions and corresponding toastr messages if needed

            if (this.selectedDocuments.length !== 0 && this.form.contact !== null) {
                // Your logic for Axios call if no errors
                axios.post(route('data.submit'), {
                    details: this.form,
                    documents: this.selectedDocuments
                }).then((response) => {
                    console.log(this.showSuccessToastr);
                    if(response.data === 'success') {
                        this.toastr('success', 'Successfully Requested');
                    }
                }).catch(error => {
                    console.error(error); // Log the error if there is any
                });
            }
        },
        removeToastr() {
            this.showSuccessToastr = false;
            this.showErrorToastr = false
            },

        addDoc() {
            if (this.selects.name && this.selects.copies) { //This will check if the document, copies, and purpose filled are filled up

                if (parseInt(this.selects.copies) > 0) { //The number of copies should be greater than 0
                    const existingDocumentIndex = this.selectedDocuments.findIndex(
                        doc =>
                            doc.document === this.selects.name &&
                            doc.purpose === this.selects.purpose
                    );
                    if (existingDocumentIndex !== -1) { 
                        //If there's already existed document with the same purpose
                        this.selectedDocuments[existingDocumentIndex].copies += parseInt(
                            this.selects.copies
                        );  
                        const selectedDocument = this.docTypes.find(
                            item => item.name === this.selects.name
                        );
                            const total = this.selectedDocuments[existingDocumentIndex].copies * selectedDocument.price;

                            this.selectedDocuments[existingDocumentIndex].price = total;
                    } else {
                        const selectedDocument = this.docTypes.find(
                            item => item.name === this.selects.name
                        );  
                        this.selectedDocuments.push({
                            id: selectedDocument.id,
                            document: this.selects.name,
                            copies: parseInt(this.selects.copies),
                            price: selectedDocument.price * parseInt(this.selects.copies),
                            purpose: this.selects.purpose,
                            docprice: selectedDocument.price

                        }); //Display a new Document
                    }
                    this.selects.name = null;
                    this.selects.copies = null;
                    this.selects.purpose = null;
                    //Set the name, copies, and purpose to null
                } else {
                    this.toastr('error', 'Number of copies must not zero');
                }
            } else {
                this.toastr('error', 'Please choose document and also the copies.');
            }
        },
    removeSelectedDocument(index) {
        this.selectedDocuments.splice(index, 1);
    }, //This will remove a document
    },
    mounted() {
        this.input = this.$refs.input;

        if (this.input.hasAttribute('autofocus')) {
            this.input.focus();
        }
        this.fetchData();

        defineEmits(['update:modelValue']);
    },
}
</script>
<template>
    <Toastr :success="showSuccessToastr" @remove="removeToastr" :error="showErrorToastr" :message="Message"/>
    <AuthenticatedLayout title="Request Form">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Request Forms
                </h2>
            </div>         
        </template>
        <form @submit.prevent="submitData">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-0 mb-4">
                <div class="grid md:grid-cols-3 md:gap-6 dark:text-white-400">
                    <div class="mt-3">
                        <InputForm :type="'date'" :label="'Date'" class="mt-1 block w-full" v-model="form.date" autocomplete="username" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6 ">
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Student Number'" class="mt-1 block w-full" v-model="form.studno" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Degree'" class="mt-1 block w-full" v-model="form.degree" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Name(Last, First, Middle)'" class="mt-1 block w-full" v-model="form.name" autocomplete="username" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="mt-3">
                        <InputForm :type="'email'" :label="'Email'" class="block w-full mt-1" v-model="form.email" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Contact Number'" class="block w-full mt-1" v-model="form.contact" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Remarks'" class="block w-full mt-1" v-model="form.remarks" autocomplete="" />
                    </div>
                </div>
            </div>
        
        <div class="overflow-hidden text-gray-500 rounded-md shadow-md dark:bg-dark-eval-1 mt-0 ">
            <table class="w-full text-sm text-left bg-white dark:text-gray-400 overflow-hidden rounded-md shadow-md dark:bg-dark-eval-1 mt-0 ">
                <tbody class="z-0 text-gray-700 bg-white dark:bg-dark-eval-1 dark:text-white dark:border-gray-600 " :type="type" required placeholder=" " :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
                    <tr class=" grid grid-cols-4 max-md:grid-cols-2">
                        <th scope=" " class="flex  py-3" >
                            <div class="flex justify-center items-center ml-1">
                                <label class="block mb-5 text-sm font-medium text-gray-900 dark:text-white"></label>
                                <select id="documents" class="bg-gray-50 flex h-10 border border-gray-400 text-gray-900 text-sm rounded-lg block  w-full focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="selects.name" required>Choose
                                    <option disabled select>Choose</option>
                                    <option v-for="doc in docTypes" :key="doc.id" :value="doc.name" >{{ doc.name }}</option>
                                </select>
                            </div>
                        </th>
                        <th>
                            <div class="flex justify-start ml-5 max-md:justify-center">
                                <input min="1" type="number" class=" mt-3 h-10 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg block w-16 p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="selects.copies" placeholder="0"/>
                            </div>
                        </th>
                        <th scope="" class=" font-semibold">
                            <input maxlength="10" placeholder="Purpose(max 10)" type="text" v-model="selects.purpose" class="mt-3 max-md:w-full block py-2.5 px-0 ml-2.5 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-green-600 peer w-full"/>
                        </th>
                        <th scope="" class="px-2 py-3 flex justify-end">
                            <button @click="addDoc" class="flex justify-center focus:outline-none max-md:w-11 text-white bg-mmsu-g hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="#" id="add_more_fields">Add</button>
                        </th>
                    </tr>
                    <tr class="flex mt-2 grid grid-cols-5 max-md:grid-cols-4 border-t-2 mb-2 border-gray-100 dark:border-gray-600 " >
                        <td scope="" class=" mt-5 text-center font-semibold" >
                            <div class="">Document</div>
                        </td >
                        <td scope="" class="text-center mt-5 font-semibold">
                            <div>Copies</div>
                        </td>
                        <td scope="" class=" mt-5 text-center font-semibold max-md:hidden">
                            <div class="">Price</div>
                        </td>
                        <td scope="" class=" mt-5 text-center font-semibold">
                            <div class="">Purpose</div>
                        </td>
                        <td scope="" class=" text-left mt-5 font-semibold">
                            <div>Total</div>
                        </td>
                    </tr>
                    <tr v-for="(document, index) in selectedDocuments" :key="index" class="flex items-center mt-2 grid grid-cols-5 border-t-2 border-gray-100 dark:border-gray-600 font-sm max-md:grid-cols-4">
                        <td scope="col" class="font-sm text-center break-all">
                            <div>{{ document.document }}</div>
                        </td>
                        <td scope="col" class="font-sm text-center">
                            <div class="">{{ document.copies }}</div>
                        </td>
                        <td scope="col" class="font-sm text-center max-md:hidden">
                            {{ document.docprice }}
                        </td>
                        <td scope="col" class="font-sm text-center break-all">
                            <div>{{ document.purpose }}</div>
                        </td>
                        <td scope="col" class="font-sm text-center flex items-center grid grid-cols-2 ">
                            <div class="text-left">
                                {{ document.price }}
                            </div>
                            <div class="flex justify-start max-md:flex items-start">
                                <button @click="removeSelectedDocument(index)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="max-md:w-6 max-md:h-6 w-8 h-8 flex justify-start">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <div class="flex justify-end items-center ">
                    <button type="submit" @click="saveData" class="focus:outline-none text-white bg-mmsu-g hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Submit
                    </button>
                </div>
            </table>  
        </div>  
    </form> 
    </AuthenticatedLayout>
</template>
