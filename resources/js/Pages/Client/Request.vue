<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import InputForm from '@/Components/InputForm.vue'
import TableHead from '@/Components/TableHead.vue';
import TableBody from '@/Components/TableBody.vue';
import { defineEmits } from 'vue';
import axios from 'axios'; // Import Axios

export default {
    data() {
        return {
            form: {
                date: new Date().toISOString().substr(0, 10),
                studno: this.details.student_number,
                degree: this.details.degree,
                name: this.details.firstname + ' ' + this.details.middlename[0] + '. ' + this.details.surname,
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
            select:{
                copies: null,
            },
            textType: 'text',
            input: null,
            docTypes: [],
            selectedDocuments: [],
            selects: { name: null, value: null },
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
    components: {AuthenticatedLayout, InputForm},
    methods: {
        fetchData(){
            axios.get('/getDocTypes').then((response) => {
                this.docTypes = response.data;
            });
        },
        async saveData() {
            // Save Data
            axios.post(route('data.submit'), {
                details: this.form,
                documents: this.selectedDocuments
            }).then((response) => {
                if(response.data == 'success') {
                    alert('Successfully Saved');
                } else {
                    alert('An Error Occurred');
                }
            });
        },
        addDoc() {
            if (this.selects.name) { //This will check if there is selected document
                
                const selectedDocument = this.docTypes.find(item => item.name === this.selects.name); // It will find the selected document in docTypes

                this.selectedDocuments.push({
                    id: selectedDocument.id,
                    document: this.selects.name,
                    copies: this.selects.value,
                    price: selectedDocument.price * this.selects.value,
                });
                this.selects[0].name = null;
                this.selects[0].value = null;
            }
        },
        removeSelectedDocument(index) {
            this.selectedDocuments.splice(index, 1);
        },
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
    <AuthenticatedLayout title="Request Form">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Request Form
                </h2>
            </div>         
        </template>
        <form @submit.prevent="submitData">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-0">
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
                        <InputForm :type="'email'" :label="'Email'" class="mt-1 block w-full" v-model="form.email" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Contact Number'" class="mt-1 block w-full" v-model="form.contact" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Remarks'" class="mt-1 block w-full" v-model="form.remarks" autocomplete="" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-center ">
                <button type="submit" @click="saveData" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Submit</button>
            </div> 
        </form>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-4 z-40 ...relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tbody class="z-0 text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-white" :type="type" required placeholder=" " :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
                    <tr class="">
                        <th scope="col" class=" py-3 ml-4" >
                            <div class="flex items-center ml-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                            <select id="documents" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="selects.name" required>
                                <option disabled select>Choose</option>
                                <option v-for="doc in docTypes" :key="doc.id" :value="doc.name" >{{ doc.name }}</option>
                            </select>
                            </div>
                        </th>
                        <th>
                            <div>
                                <input type="number" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg block w-16 p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="selects.value" placeholder="0"/>
                            </div>
                        </th>
                        <th scope="col" class="px-2 py-3 flex justify-start">
                            <button @click="addDoc" class="flex justify-center focus:outline-none max-md:w-11 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="#" id="add_more_fields">Add</button>
                        </th>
                        <th></th>
                        
                        <th>
                        </th>
                    </tr>

                    <tr class="mt-5 " >
                        <th scope="col" class="py-3 mt-5 " >
                            <div class="ml-2 text-left">Document</div>
                        </th >
                        <th scope="col" class="py-3 mt-5">
                            <div class="text-center">Purpose</div>
                        </th>
                        <th scope="col" class="py-3 text-center">
                            <div>Copies</div>
                        </th>
                        <th scope="col" class="text-center">
                            <div>Price</div>
                        </th>
                        <th></th>
                    </tr>

                    <tr v-for="(document, index) in selectedDocuments" :key="index">
                        <th scope="col" class="px-2 py-3 font-semibold">
                            <div>{{ document.document }}</div>
                        </th>
                        <th scope="col" class=" font-semibold ">
                            <input type="text" v-mpdel="purpose" class="block py-2.5 text-sm mr-2 text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer w-full max-md:w-16"/>
                        </th>
                        <th scope="col" class="px-2 py-3 font-semibold text-center">
                            <div class="">{{ document.copies }}</div>
                        </th>
                        <th scope="col" class="px-2 py-3 font-semibold text-center">
                            {{ document.price }}
                        </th>
                        <th scope="col">
                            <button @click="removeSelectedDocument(index)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 flex justify-start">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            </button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>  

    </AuthenticatedLayout>
</template>
