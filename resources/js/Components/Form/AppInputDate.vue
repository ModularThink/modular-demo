<template>
    <label class="mb-1 flex" :for="name">
        {{ label }}
    </label>

    <input
        :id="name"
        type="date"
        :name="name"
        :value="modelValue"
        class="date-picker focus:ring-primary-focus bg-neutral-1 text-neutral-12 placeholder-neutral-9 ring-neutral-7 mt-1 block w-full rounded-md border-0 px-3 py-2 ring-1 shadow-xs ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
        :class="$attrs.class"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        default: ''
    }
})

defineOptions({
    inheritAttrs: false
})

defineEmits(['update:modelValue'])
</script>

<style scoped>
html.dark-theme .date-picker {
    color-scheme: dark;
}
</style>
