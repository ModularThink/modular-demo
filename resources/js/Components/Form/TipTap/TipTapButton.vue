<template>
    <button
        :title="title"
        class="text-neutral-11 hover:bg-neutral-3 hover:text-neutral-12 m-0 h-6 w-6 cursor-pointer overflow-visible border-none bg-transparent bg-no-repeat p-0 text-center font-sans text-sm leading-5 break-words normal-case hover:rounded-xs"
    >
        <i
            class="text-centertext-sm m-0 cursor-pointer bg-no-repeat p-0 leading-5 break-words not-italic"
            :class="icon"
        ></i>
    </button>
</template>

<script setup>
defineProps({
    title: {
        type: String,
        default: ''
    },
    icon: {
        type: String,
        default: ''
    }
})
</script>
