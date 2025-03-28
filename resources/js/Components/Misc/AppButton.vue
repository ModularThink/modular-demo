<template>
    <button type="button" @click="$emit('click')">
        <slot></slot>
    </button>
</template>

<script setup>
defineEmits(['click'])
</script>

<style scoped>
@reference "../../../css/app.css";

.btn {
    @apply z-0 flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:cursor-pointer focus-visible:outline focus-visible:outline-offset-2;
}

.btn-primary {
    @apply bg-primary-9 text-primary-1 hover:bg-primary-10 focus-visible:outline-primary-9;
}

.btn-secondary {
    @apply bg-primary-3 text-primary-11 hover:bg-primary-4 focus-visible:outline-primary-11;
}

.btn-neutral {
    @apply bg-neutral-3 text-neutral-12 hover:bg-neutral-4 focus-visible:outline-neutral-11;
}

.btn-destructive {
    @apply bg-error text-error-light hover:bg-error-dark focus:ring-error;
}

.btn-primary-outline {
    @apply border-primary-7 text-primary-11 hover:bg-primary-4 focus-visible:outline-primary-11 border;
}

.btn-neutral-outline {
    @apply border-neutral-7 text-neutral-12 hover:bg-neutral-4 focus-visible:outline-neutral-11 border;
}

.btn-icon {
    @apply h-8 rounded-md px-3;
}
</style>
