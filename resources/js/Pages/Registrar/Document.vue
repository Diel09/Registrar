<script setup>
import Registrar from '@/Layouts/Registrar.vue'
import Forms from '@/Components/DocForm.vue'
import Chart from '@/Components/Chart.vue'
import { GithubIcon } from '@/Components/Icons/brands'
import { onMounted, ref } from 'vue';
import axios from 'axios';

// Create a variable to store the retrieved data
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

// Trigger the GET request when the component is mounted
onMounted(() => {
  fetchData();
});
defineProps({
    'title': String,
    'name': String,
});


const item = ref({ id: 1 });

const deleteItem = (id) => {
  axios
    .delete(`/api/items/${id}`)
    .then((response) => {
      console.log(response.data.message);
      // Handle any other UI updates if needed
    })
    .catch((error) => {
      console.error('Error deleting item:', error);
      // Handle error and show a message to the user
    });
};

</script>


<template>
    <Registrar title="Registrar" :username="name">
        <template #header>
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 grid grid-cols-1 md:grid grid-cols-2">
                <div class="flex items-center font-semibold">
                    Documents
                </div>
                <div>
                    <Forms/>
                </div>
                
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-3 py-4">Document Types</th>
                                        <th scope="col" class="px-3 py-4">Price</th>
                                        <th scope="col" class="px-3 py-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in responseData">
                                        <td class="px-3 py-4 font-medium">
                                            {{item.name}}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{item.price}}
                                        </td>
                                        <td class="px-3 py-4">
                                            <button type="button" class="text-white bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700">Edit</button>
                                            <button type="button" @click="deleteItem(item.id)" class="text-white bg-red-800 hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-red-800 dark:hover:bg-red-600 dark:focus:ring-red-500 dark:border-gray-700">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Registrar>
</template>