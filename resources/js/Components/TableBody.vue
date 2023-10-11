<script setup>
import { onMounted, ref } from 'vue';
import InputForm from '@/Components/InputForm.vue';

defineProps(['modelValue', 'label', 'type']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>

<template>
    <tbody class=" z-0 text-gray-700 dark:bg-gray-700 dark:text-white" id="default-checkbox"
        :type="type"          
        required
        placeholder=" "
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <tr>
            <th scope="col" class="py-3 ">
                <div class="flex items-center space-x-3">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                    <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose</option>
                        <option value="TOR">Transcript of Records</option>
                        <option value="diploma">Diploma</option>
                        <option value="graduation">Certification of Graduation</option>
                        <option value="COE">Certification of Enrolment</option>
                        <option value="cert_grade">Certification of Grades</option>
                        <option value="cert_units">Certification of Units Earned</option>
                        <option value="GWA">Certification of GWA/GPA</option>
                        <option value="authentication">Authentication</option>
                    </select>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                <div class="focus:ring-green-500 focus:border-green-500">
                    <input type="number" id="first_product" class="border border-gray-300 text-gray-700 text-sm rounded-lg block px-2.5 py-1 focus:ring-green-500 focus:border-green-500 dark:text-white w-16 dark:bg-gray-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required/>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>
        </tr>
    </tbody>
</template> 







<!-- 
<template>

    <tbody class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" id="default-checkbox"
            :type="type"          
            required
            placeholder=" "
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">

        <div class="flex items-center space-x-3">
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a document</option>
                <option value="TOR">Transcript of Records</option>
                <option value="diploma">Diploma</option>
                <option value="graduation">Certification of Graduation</option>
                <option value="COE">Certification of Enrolment</option>
                <option value="cert_grade">Certification of Grades</option>
                <option value="cert_units">Certification of Units Earned</option>
                <option value="GWA">Certification of GWA/GPA</option>
                <option value="authentication">Authentication</option>
            </select>

            </div>

                
            
            <div>
                <InputForm type="number" id="first_product" class="bg-gray-50 w-44 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required/>
            </div>
            
           

        

    </tbody>

</template>  -->