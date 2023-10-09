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
            id="input"
            :type="type"
            class="block py-2.5 px-0 ml-2.5 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer "
            required
            placeholder=" "
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"
            />
        <label  
            for="input"
            class="absolute text-sm text-white-200 dark:text-white-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-gray-600 peer-focus:dark:text-gray-200 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 ">
            {{ label }}
        </label>
    </div>
</template> 

