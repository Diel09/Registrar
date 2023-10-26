<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import InputForm from '@/Components/InputForm.vue'
import TableHead from '@/Components/TableHead.vue';
import TableBody from '@/Components/TableBody.vue';
import {ref} from 'vue';
import axios from 'axios'; // Import Axios

export default {
    data() {
        return {
            form: {
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
            },
            textType: 'text',
            selectedDate: new Date().toISOString().substr(0, 10)
        }
    }, 
    props: ['details'],
    components: {AuthenticatedLayout, InputForm, TableBody, TableHead},
    methods: {
        
    }
}

const input = ref(null);
const stud_no = ref('');
const alumni_id = ref('');
const saveData = async () => {
  // Create a JavaScript object with your text data
  const dataToSend = {
    stud_no:stud_no.value,
    alumni_id: alumni_id.value,
  };

  try {
    const response = await axios.post(route('data.submit'), dataToSend);
    // Handle success response
    console.log(response.data);
  } catch (error) {
    // Handle error response
    console.error(error);
  }
};
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

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-0">
            <form @submit.prevent="submitData">
                <div class="grid md:grid-cols-3 md:gap-6 dark:text-white-400">
                    <div class="mt-3">
                        <InputForm :type="'date'" :label="'Date'" class="mt-1 block w-full" v-model="selectedDate" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Student Number'" class="mt-1 block w-full" v-model="form.studno" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Degree'" class="mt-1 block w-full" v-model="form.degree" autocomplete="username" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6 ">
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Name(Last, First, Middle)'" class="mt-1 block w-full" v-model="form.name" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="'email'" :label="'Email'" class="mt-1 block w-full" v-model="form.email" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Contact Number'" class="mt-1 block w-full" v-model="form.contact" autocomplete="username" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Purpose'" class="mt-1 block w-full" v-model="form.purpose" autocomplete="username" />
                    </div>
                    <div class="mt-3">
                        <InputForm :type="textType" :label="'Remarks'" class="mt-1 block w-full" v-model="form.remarks" autocomplete="username" />
                    </div>
                </div>
            </form>
        </div>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mt-4">
            <div class="z-40 ...relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <TableHead/>
                    <TableBody/>
                </table>
                <div class="flex justify-end items-center ">
                    <button type="button" @click="saveData" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Submit</button>
                </div> 
            </div>
        </div>    
    </AuthenticatedLayout>
</template>
