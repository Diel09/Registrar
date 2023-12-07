<script setup>
import { onMounted, ref, reactive } from 'vue';

defineProps(['modelValue', 'label', 'type']);

defineEmits(['update:modelValue']);

const input = ref(null);
const searchQuery = ref('');
const filteredProducts = reactive([]);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <form class="block mb-2 text-sm font-medium text-gray-900 dark:text-white md:" id="default-checkbox" :type="type" required placeholder=" " :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <div class="flex justify-end mt-2" >
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" v-model="searchQuery" @input="$emit('search', searchQuery)" placeholder="Search Reference Number" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
        </div>
        
    </form>
</template> 
