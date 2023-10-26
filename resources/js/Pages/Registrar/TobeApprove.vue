<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Filter from '@/Components/Filter.vue'
import Search from '@/Components/Search.vue'
import { GithubIcon } from '@/Components/Icons/brands'
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

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 grid grid-cols-2">
            <div>
                <div>Name:</div>
                <div>Student No:</div>
                <div>Document Type:</div>
                <div>No. Copies:</div>
            </div>
            <div class="flex justify-end items-center">
                    <label for="tw-modal" class="text-white bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700 w-28 h-14 flex justify-center items-center font-semibold">
                        View
                    </label>

                    <input type="checkbox" id="tw-modal" class="z-40 peer fixed appearance-none opacity-0">

                        <label for="tw-modal" class="z-40 pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
                            <div  class=" h-fit max-w-lg scale-90 overflow-y-auto overscroll-contain rounded-md bg-gray-500 p-6 text-black shadow-2xl transition">
                                <div class="text-center font-semibold text-white">
                                    <h2>Add Documents</h2>
                                </div>
                                <form @submit.prevent="submitData">
                                    <div class="mt-7  border-black">
                                        <label for="" class="text-white">Name: </label>
                                        <input type="text" name="Name" placeholder="Document" v-model="doc_name" class="text-gray-500">
                                    </div>
                                    <div class="mt-3 mb-4">
                                        <label for="" class="text-white">Student No: </label>
                                        <input type="text" name="Student_Number" placeholder="Student Number" v-model="price" class="text-gray-500">
                                    </div>
                                    <div class="mt-3 mb-4">
                                        <label for="" class="text-white">Document Type: </label>
                                        <input type="text" name="Document_Type" placeholder="Document Type" v-model="price" class="text-gray-500">
                                    </div>
                                    <div class="mt-3 mb-4">
                                        <label for="" class="text-white">No. of Copies: </label>
                                        <input type="text" name="Number_Copies" placeholder="Number of Copies" v-model="price" class="text-gray-500">
                                    </div>
                                    <div class="flex justify-end items-center ">
                                        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Done</button>
                                    </div>
                                </form>
                            </div>
                        </label> 

                </div>  
        </div>
    </Registrar>
</template>