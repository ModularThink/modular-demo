<template>
    <div class="mx-auto my-6 max-w-7xl px-6 lg:px-9">
        <div class="grid grid-cols-1 gap-9 lg:grid-cols-3">
            <ArchiveSelector
                :archive-options="archiveOptions"
            ></ArchiveSelector>
            <TagSelector :tags="tags"></TagSelector>
            <SearchInput></SearchInput>
        </div>
    </div>
</template>

<script setup>
import ArchiveSelector from './ArchiveSelector.vue'
import TagSelector from './TagSelector.vue'
import SearchInput from './SearchInput.vue'

defineProps({
    tags: {
        type: Array,
        default: () => []
    },
    archiveOptions: {
        type: Array,
        default: () => []
    }
})
</script>
