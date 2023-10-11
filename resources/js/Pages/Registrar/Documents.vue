<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Button from '@/Components/Button.vue'
import { GithubIcon } from '@/Components/Icons/brands'
</script>

<template>
    <Registrar title="Registrar">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Documents
                </h2>
            </div>
        </template>

        
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-3 py-3">
                    Document Type
                </th>
                <th scope="col" class="px-3 py-3">
                    No. Of Copies
                </th>
                <th scope="col" class="px-3 py-3">
                    Price
                </th>
                <th scope="col" class="px-3 py-3">Action
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Transcript of record
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    200
                </td>
                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Diploma
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    50
                </td>
                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Certificate of Graduation
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    20
                </td>

                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Certificate of Enrolment
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    20
                </td>

                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Certificate of Grade
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    20
                </td>

                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            
            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Certificate of Units Earned
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    20
                </td>

                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Certificate of DWA/GPA
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    20
                </td>

                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>

            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Authentication
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    20
                </td>

                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Transfer Credential/Hon. Dismissal
                </th>
                <td class="px-3 py-3">
                    1
                </td>
                <td class="px-3 py-3">
                    20
                </td>

                <td class="px-3 py-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>

    </Registrar>
</template>