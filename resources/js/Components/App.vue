<template>
    <div class="flex justify-end">
        <label for="tw-modal" class="flex items-center text-white text-sm bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Add Documents
        </label>

        <input type="checkbox" id="tw-modal" class="z-40 peer fixed appearance-none opacity-0">

        <label for="tw-modal" class="z-40 pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
            <div  class=" h-fit max-w-lg scale-90 overflow-y-auto overscroll-contain rounded-md bg-gray-500 p-6 text-black shadow-2xl transition">
                <div class="text-center font-semibold text-white">
                    <h2>Add Documents</h2>
                </div>
                <form @submit.prevent="addDocuments">
                    <div class="mt-7  border-black">
                        <label for="" class="text-white">Document: </label>
                        <input type="text" name="document" placeholder="Document" v-model="name" class="text-gray-500" required>
                    </div>
                    <div class="mt-3 mb-4">
                        <label for="" class="text-white">Price: </label>
                        <input type="text" name="price" placeholder="Price" v-model="price" class="text-gray-500">
                    </div>
                    <div class="flex justify-end items-center ">
                        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">ADD</button>
                    </div>
                </form>
            </div>
        </label> 
    </div>
</template>

<script>
import axios from 'axios';

export default{
    data(){
        return{
            doc_type:{
                name: '',
                price: '',
            }
        }
    },
    methods:{
        addDocuments(){
            axios.post('/saveDocs')
            .then(response => {
                alert('Item Saved:', response.data);
            })
            .catch(error => {
                alert('Unable to save.', error);
            })
        }
    }
}
</script>