    <script setup>
    import { onMounted, ref } from 'vue';
    import axios from 'axios'; // Import Axios

    defineProps(['modelValue', 'label', 'type']);

    defineEmits(['update:modelValue']);

    const input = ref(null);
    const name = ref('');
    const price = ref('');
    const uploadData = async () => {
    // Create a JavaScript object with your text data
    const dataToSend = {
    name:name.value,
    price: price.value,
    };

    try {
    const response = await axios.post(route('data.upload'), dataToSend);
    // Handle success response
    console.log(response.data);
    } catch (error) {
    // Handle error response
    console.error(error);
    }
    };

    onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
    }
    });

    </script>

    <template>
    <div class="z-0 text-gray-700 dark:bg-dark-eval-1 dark:text-white" id="default-checkbox"
    :type="type"          
    required
    placeholder=" "
    :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
    <div class="flex justify-end">
        <label for="tw-modal" class="flex items-center text-white text-sm bg-green-800 hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full px-5 py-2.5 mr-2 mb-2 dark:bg-blue-800 dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Add Documents
        </label>
        <input type="checkbox" id="tw-modal" class="fixed z-40 opacity-0 appearance-none peer">

        <label for="tw-modal" class="z-40 pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100">
            <div  class="max-w-lg p-6 overflow-y-auto text-black transition scale-90 rounded-md shadow-2xl bg-gray-50 h-fit overscroll-contain">
                <div class="font-semibold text-center text-black">
                    <h2>Add Documents</h2>
                </div>
                <form @submit.prevent="submitData" class="grid grid-cols-2">
                <div>
                    <div class="border-black mt-7">
                        <label for="" class="text-black">Document: </label>
                        <input type="text" name="document" placeholder="Document" v-model="name" class="text-gray-500">
                    </div>
                    <div class="mt-3 mb-4">
                        <label for="" class="text-black">Price: </label>
                        <input type="text" name="price" placeholder="Price" v-model="price" class="text-gray-500">
                    </div>
                </div>
                    <div class="flex items-center justify-end ">
                        <button type="submit" @click="uploadData" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">ADD</button>
                    </div>
                </form>
            </div>
        </label> 
    </div>
    </div>
    </template> 


