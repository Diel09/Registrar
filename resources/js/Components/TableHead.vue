<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <thead class=" z-0 text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-white" id="default-checkbox"
        :type="type"          
        required
        placeholder=" "
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <tr>
            <th scope="col" class="px-6 py-3 ">
                Document Requested
            </th>
            <th scope="col" class="px-6 py-3">
                No. of Copies
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>
        </tr>
    </thead>
</template> 
