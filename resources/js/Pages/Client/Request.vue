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
            // select:{
            //     copies: null,
            // },
            textType: 'text',
            input: null,
            docTypes: [],
            selectedDocuments: [],
            selects: { 
                name: null, 
                copies: null,
                purpose: null
             },
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
            if (this.selects.name && this.selects.copies) { //This will check if there is selected document
                
                const selectedDocument = this.docTypes.find(item => item.name === this.selects.name); // It will find the selected document in docTypes

                this.selectedDocuments.push({
                    id: selectedDocument.id,
                    document: this.selects.name,
                    copies: this.selects.copies,
                    price: selectedDocument.price * this.selects.copies,
                    purpose: this.selects.purpose,
                });
                this.selects.name = null;
                this.selects.copies = null;
                this.selects.purpose = null;
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
                    Request Forms
                </h2>
            </div>         
        </template>
        <form @submit.prevent="submitData">
            <div class="p-6 mt-0 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="grid md:grid-cols-3 md:gap-6 dark:text-white-400">
                    <div class="mt-3">
                        <InputForm :type="'date'" :label="'Date'" class="block w-full mt-1" v-model="selectedDate" autocomplete="username" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6 ">
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Student Number'" class="block w-full mt-1" v-model="form.studno" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Degree'" class="block w-full mt-1" v-model="form.degree" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Name(Last, First, Middle)'" class="block w-full mt-1" v-model="form.name" autocomplete="username" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="mt-3">
                        <InputForm :type="'email'" :label="'Email'" class="block w-full mt-1" v-model="form.email" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Contact Number'" class="block w-full mt-1" v-model="form.contact" autocomplete="username" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Purpose'" class="block w-full mt-1" v-model="form.purpose" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Remarks'" class="block w-full mt-1" v-model="form.remarks" autocomplete="" />
                    </div>
                </div>
            </div>
            <div class="p-6 mt-4 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <div class="z-40 ...relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <TableBody @addDocument="addDoc"/>
                    </table>
                    <div class="flex items-center justify-end ">
                        <button type="submit" @click="saveData" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Submit</button>
                    </div> 
                </div>
            </div>  
      </form>
    </AuthenticatedLayout>
</template>
