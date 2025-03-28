<template>
    <input
        ref="inputRef"
        :value="modelValue"
        class="bg-neutral-1 text-neutral-12 placeholder-neutral-9 ring-neutral-7 focus:ring-neutral-7 mt-1 block w-full rounded-md border-0 px-3 py-2 ring-1 shadow-xs ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
import { ref } from 'vue'

defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    }
})

defineEmits(['update:modelValue'])

const inputRef = ref(null)

const focusInput = () => {
    inputRef.value.focus()
}

defineExpose({
    focusInput
})
</script>
