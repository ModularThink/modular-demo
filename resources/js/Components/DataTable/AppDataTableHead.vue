<template>
    <thead>
        <tr>
            <th
                v-for="header in headers"
                :key="header"
                class="border-neutral-6 bg-neutral-5 border px-2 py-2"
            >
                {{ header }}
            </th>
        </tr>
    </thead>
</template>

<script setup>
defineProps({
    headers: {
        type: Array,
        default: () => []
    }
})
</script>
