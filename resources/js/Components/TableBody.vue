<script setup>
import { onMounted, ref } from 'vue';


defineProps(['modelValue', 'label', 'type']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

const responseData = ref(null);
// const document = ref(props.document);

// Define a method to make a GET request
const fetchData = async () => {
  try {
    const response = await axios.get('/getDocTypes'); // Replace with your actual endpoint
    responseData.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

onMounted(() => {
  fetchData();
});

</script>

<template>
    <tbody class=" z-0 text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-white" id="default-checkbox"
        :type="type"          
        required
        placeholder=" "
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <tr>
            <th scope="col" class="py-3">
                <div class="flex items-center space-x-3"  >
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                    <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose</option>
                        <option v-for="item in responseData" value="TOR">{{item.name}}</option>
                    </select>
                </div>
            </th>
            <th scope="col" class="px-4 py-3">
                <div class="focus:ring-green-500 focus:border-green-500">
                    <input type="number" id="first_product" class="border border-gray-300 text-gray-700 text-sm rounded-lg block px-2.5 py-1 focus:ring-green-500 focus:border-green-500 dark:text-white w-16 dark:bg-gray-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required/>
                </div>
            </th>
            <th scope="col" class="py-3 flex justify-start">
                <a class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5 " href="#" id="add_more_fields" @click="AddSelectInput">ADD</a>
            </th>
        </tr>
    </tbody>
</template> 
