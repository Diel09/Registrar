<script>
import { defineEmits } from 'vue';
import axios from 'axios';

export default {
  data() {
    return {
      selects:{
          document:null,
          copies:null,
      },
      input: null,
      responseData: null,
      selectedDocuments: [],
      selects: [{ name: null, value: null,}],
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
        const response = await axios.get('/getDocTypes');
        this.responseData = response.data;
      } catch (error) {
          console.error('Error fetching data:', error);
        }
    },
    addSelectInput() {
      this.selectedDocuments.push({
        document: this.selects[0].document,
        copies: this.selects[0].copies,
      });
      this.selects[0].document = null;
      this.selects[0].copies = null;
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
};
</script>

<template>
  <tbody class="z-0 text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-white" :type="type" required placeholder=" " :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"> 
    <tr v-for="(select, index) in selects" :key="index" class="">
      <th scope="col" class="ml-2 py-3" >
        <div class="flex items-center">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
          <select  id="documents" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="select.document" required>
            <option select>Choose</option>
            <option v-for="item in responseData" :value="item.name">{{item.name}} {{item.price}}</option>
          </select>
        </div>
      </th>
      <th>
        <div>
          <input type="number" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg block w-16 p-2.5 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="select.copies" placeholder="0" required/>
        </div>
      </th>
      <th>

      </th>
      <th scope="col" class="px-2 py-3">
        <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="#" id="add_more_fields" @click="addSelectInput">Add</button>
      </th>
      <th>
      </th>
      
    </tr>

    <tr class="mt-5 " >
      <th scope="col" class="px-2 py-3 mt-5" >
        Document
      </th >
      <th scope="col" class="px-2 py-3 mt-5">
        Purpose
      </th>
      <th scope="col" class="px-2 py-3 ">
        <div>Copies</div>
      </th>
      <th scope="col">
        <div>Price</div>
      </th>
      <th>

      </th>
    </tr>

    <tr v-for="(document, index) in selectedDocuments" :key="index">
      <th scope="col" class="px-2 py-3 font-semibold">
        {{ document.document }}
      </th>
      <th scope="col" class="px-2 py-3 font-semibold ml-4 ">
        <input type="text" class="max-md:w-16">
        
      </th>
      <th scope="col" class="px-2 py-3 font-semibold ml-4 ">
        {{ document.copies }}
        
      </th>
      <th>
        
      </th>
      <th scope="col">
        <button @click="removeSelectedDocument(index)">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </button>
      </th>
      
    </tr>
  </tbody>
</template>