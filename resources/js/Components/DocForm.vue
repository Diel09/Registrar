<script setup>
    import { onMounted, ref, defineEmits, defineProps } from 'vue';
    import axios from 'axios'; // Import Axios
    import inputs from '@/Components/Input.vue'
    import Label from '@/Components/Label.vue'
    import Toastr from '@/Components/Toastr.vue'

    const {modelValue, label, type, fetchData} = defineProps(['modelValue', 'label', 'type', 'fetchData']);

    const emit = defineEmits(['update:modelValue'], ['refresh']);

    const input = ref(null);
    const docname = ref('');
    const price = ref('');
    const documentSuggestions = ref([]);
    const showModal = ref(false);
    const rqst = ref([]);
    const currentRequest = ref(null);
    const docReq = ref(null);
    const dtls = ref([]);
    const showSuccessToastr =ref(false);
    const showErrorToastr = ref(false);
    const Message = ref(null);

    const changeDocs = (i) => {
        showModal.value = true;

        if (rqst.value) {
            rqst.value.forEach((value, index) => {
                if(index == i) {
                    currentRequest.value = value;
                }
            });
        }

        if(docReq.value){
            docReq.value.forEach((value, index) => {
                if(index == i) {
                    dtls.value = value;
                }
            });
        };
    }
    
    const toastr = async (type, message) => {
        if (type === 'success') {
        showSuccessToastr.value = true;
        } else if (type === 'error') {
            showErrorToastr.value = true;
        }
        Message.value = message;

        setTimeout(() => {
            removeToastr();
        }, 4000);
    }

    const removeToastr = async() => {
            showSuccessToastr.value = false;
            showErrorToastr.value = false
    }

    const uploadData = async () => {
        if (!docname.value.trim() || !price.value.trim()) {
            return;
        }
        const dataToSend = {
            name:docname.value,
            price: price.value,
            };
            showModal.value = false;
            toastr('success', 'Document added successfully.');
        try {
            const response = await axios.post(route('data.upload'), dataToSend);
                // Handle success response
            fetchData();
            docname.value = null;
            price.value = null;
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
            this.toastr('error', 'Failed to add document. Please try again.');
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
        <Toastr :success="showSuccessToastr" @remove="removeToastr" :error="showErrorToastr" :message="Message"/>
        <div class="z-0 text-gray-700 dark:bg-gray-700 dark:text-white" id="default-checkbox" :type="type" requiredplaceholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
            <div class="flex items-center justify-end" >
                <label @click="changeDocs(index)" class="flex justify-end focus:outline-none max-md:w-40 text-white bg-mmsu-g hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Documents
                </label> 
            </div>                                          
            <div v-if="showModal" class="backdrop-blur-sm flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="flex justify-end items-start">
                    
                </div>
                <div class="relative w-96 max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class=" relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold dark:text-white text-black">
                                Add Document
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
                            <form @submit.prevent="submitData" class="">
                                <datalist id="documentSuggestions">
                                    <option v-for="document in documentSuggestions" :key="document.id" :value="document.description"></option>
                                </datalist>
                                <div>
                                    <div class="border-black mt-7 ml-5">
                                        <Label value="Document" class="mb-2"/>
                                        <div class="relative">
                                            <div class="absolute inset-y-2.5 flex items-left pl-3 pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            </div>
                                            <inputs class=" rounded-md indent-5 w-80 py-1"
                                                v-model="docname"
                                                :type="type"
                                                required
                                                placeholder="Document"
                                                @input="$emit('update:modelValue', $event.target.value)"
                                                ref="input"
                                                list="documentSuggestions"
                                            />
                                        </div>
                                </div>
                                <div class="mt-3 ml-5 mb-2">
                                    <Label value="Price" class="mb-2"/>  
                                    <div class="relative">
                                        <div class="absolute inset-y-2.5 left-0 flex items-left pl-3 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <inputs type="text" name="price" placeholder="Price" v-model="price" class="text-gray-500 rounded-md indent-5 w-80"/>
                                    </div>
                                </div>
                                </div>
                                    <div class="flex items-end justify-end ">
                                        <button type="submit" @click="uploadData" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ADD</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template> 