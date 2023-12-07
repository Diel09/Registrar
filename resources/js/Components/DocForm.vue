    <script setup>
    import { onMounted, ref, defineEmits } from 'vue';
    import axios from 'axios'; // Import Axios

    defineProps(['modelValue', 'label', 'type']);

    defineEmits(['update:modelValue']);

    

    const input = ref(null);
    const docname = ref('');
    const price = ref('');
    const documentSuggestions = ref([]);
    const showModal = ref(false);
    const rqst = ref([]);
    const currentRequest = ref(null);
    const docReq = ref(null);
    const dtls = ref([]);

    const changeDocs = (i) => {
    showModal.value = true;
    rqst.value.forEach((value, index) => {
        if(index == i) {
            currentRequest.value = value;
        }
    });
    docReq.value.forEach((value, index) => {
        if(index == i) {
            dtls.value = value;
        }
    });
};

    const uploadData = async () => {
    // Create a JavaScript object with your text data
    const dataToSend = {
        name:docname.value,
        price: price.value,
        };
        showModal.value = false;

    try {
    const response = await axios.post(route('data.upload'), dataToSend);
        // Handle success response
        console.log(response.data);
        } catch (error) {
        // Handle error response
        console.error(error);
        }
    };
    const fetchDocumentSuggestions = async () => {
        try {
            const response = await axios.get('/document/suggestions');
            documentSuggestions.value = response.data;
        } catch (error) {
            console.error(error);
        }
        };

    onMounted(() => {
        if (input.value.hasAttribute('autofocus')) {
            input.value.focus();
        }
        fetchDocumentSuggestions();
        });

    </script>

    <template v-if="showModal">
        <div class="z-0 text-gray-700 dark:bg-dark-eval-1 dark:text-white" id="default-checkbox" :type="type" requiredplaceholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
            <div class="flex items-center justify-end" >
                <label @click="changeDocs(index)" class="flex justify-end focus:outline-none max-md:w-40 text-white bg-mmsu-g hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Documents
                </label> 
            </div>                                          
            <div v-if="showModal" class="backdrop-blur-sm flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-96 max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class=" relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-mmsu-g dark:bg-blue-600">
                            <h3 class="text-xl font-semibol dark:text-white text-white">
                                Request Details
                            </h3>
                            <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="">
                            <form @submit.prevent="submitData" class="grid grid-cols-2">
                                <datalist id="documentSuggestions">
                                    <option v-for="document in documentSuggestions" :key="document.id" :value="document.description"></option>
                                </datalist>
                                <div>
                                    <div class="border-black mt-7">
                                        <label for="" class="text-black ml-5 dark:text-white">Document: </label>
                                        <input
                                            class="ml-5"
                                            v-model="docname"
                                            :type="type"
                                            required
                                            placeholder="Document"
                                            @input="$emit('update:modelValue', $event.target.value)"
                                            ref="input"
                                            list="documentSuggestions"
                                            />
                                </div>
                                <div class="mt-3 mb-4 ml-5">
                                    <label for="" class="text-black dark:text-white">Price: </label>
                                    <input type="text" name="price" placeholder="Price" v-model="price" class="text-gray-500">
                                </div>
                                </div>
                                    <div class="flex items-center justify-end ">
                                        <button type="submit" @click="uploadData" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">ADD</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template> 