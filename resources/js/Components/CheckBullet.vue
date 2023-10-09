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


</script>

<template>
    <div class="relative border-none dark:text-white">
        <input
            id="default-checkbox"
            :type="type"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            required
            placeholder=" "
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"
            />
        <label  
            for="input"
            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
            {{ label }}
        </label>
    </div>
</template> 

