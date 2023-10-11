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
    <form class="block mb-2 text-sm font-medium text-gray-900 dark:text-white md:" id="default-checkbox"
        :type="type"          
        required
        placeholder=" "
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <div class="flex justify-end" >
                <select id="countries" class="w-32 h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Filters</option>
                <option value="complete">Complete</option>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="claimed">Claimed</option>
                </select>
            </div>
        </form>
</template> 