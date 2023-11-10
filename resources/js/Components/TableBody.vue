<script>
import { defineEmits } from 'vue';
import axios from 'axios';

export default {
  data() {
    return {
      selects:{
          copies:null,
      },
      input: null,
      responseData: null,
      selects: [{ name: null, value: null }],

      
    };
  },
  props: {
    modelValue: {
      type: [String, Number],
      required: true,
    },
    label: String,
    type: String,
  },
  methods: {
    fetchData: async function () {
      try {
        const response = await axios.get('/getDocTypes'); // Replace with your actual endpoint
        this.responseData = response.data;
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    addSelectInput() {
      this.selects.push({ name: null, value: null, copies: null });
    },
    removeSelectInput(index) {
      this.selects.splice(index, 1);
    },
    async saveDoc() {
      // Create a JavaScript object with your text data
    try {  
      if (this.selects.some(select => !Number.isInteger(select.copies))) {
        console.error("The copies must be an integer.");
          return;
        }
      const dataToSend = {
        copies: this.selects.length > 0 ? this.selects[0].copies : null,
        
      };
        const response = await axios.post(route('data.save'), dataToSend);
        // Handle success response
        console.log(response.data);
        this.resetForm();
      } catch (error) {
        // Handle error response
        console.error(error);
      }
    },
  },
  mounted() {
    this.input = this.$refs.input;

    // Check for the 'autofocus' attribute and focus the element
    if (this.input.hasAttribute('autofocus')) {
      this.input.focus();
    }

    // Fetch data on component mount
    this.fetchData();

    defineEmits(['update:modelValue']);
  },
};
</script>

<template>
  <tbody class="z-0 text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-white" :type="type" required placeholder=" " :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"> 
    <tr>
        <th scope="col" class="px-6 py-3 justify-center">
            Document Requested
        </th>
        <th scope="col" class="px-4 py-3 justify-center">
            No. of Copies
        </th>

        <th scope="col" class="px-2 py-3">
            <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5" href="#" id="add_more_fields" @click="addSelectInput">Add</button>
        </th>
    </tr>

    <tr v-for="(select, index) in selects" :key="index">
        <th scope="col" class="py-3">
            <div class="flex items-center space-x-3">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                <select id="documents" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option select>Choose</option>
                    <option v-for="item in responseData" :value="item.name">{{ item.name }}</option>
                </select>
            </div>
        </th>
        <th scope="col" class="px-4 py-3">
          <div class="focus:ring-green-500 focus:border-green-500">
            <input type="number" class="border border-gray-400 text-gray-900 text-sm rounded-lg block px-2.5 py-1 focus:ring-green-500 focus:border-green-500 dark:text-white w-16 dark:bg-gray-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
              v-model="select.copies" placeholder="0" required/>
          </div>
        </th>

        <th scope="col" class="py-3 flex justify-start">
            <button class="ml-5 mt-1" href="#" @click="removeSelectInput(index)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </th>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>
          <!-- <button type="submit" @click="saveDoc" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5">
            Save
          </button> -->
        </td>
      </tr>
  </tbody>
</template>