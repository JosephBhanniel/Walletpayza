<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: Number, // Change the prop type to Number
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        type="number" 
        :value="modelValue"
        @input="$emit('update:modelValue', parseFloat($event.target.value))" 
    >
</template>
