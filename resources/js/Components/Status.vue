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
    <form class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " id="default-checkbox"
        :type="type"          
        required
        placeholder=""
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">

        <div class="flex justify-end" >
            <select id="status" class="w-32 bg-green-600 border border-gray-300 text-white text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Status</option>
            <option value="complete">Complete</option>
            <option value="claimed">Claimed</option>
            </select>
        </div>
    </form>
</template> 