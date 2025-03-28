<template>
    <div class="bg-skin-neutral-1 h-12">
        <AppCombobox
            v-model="selectedArchiveOption"
            :options="archiveOptionsList"
            :use-search="false"
            combo-label="Archive"
            class="w-full"
        />
    </div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue'

const props = defineProps({
    archiveOptions: {
        type: Array,
        default: () => []
    }
})

const archiveOptionsList = ref([])

onMounted(() => {
    props.archiveOptions.forEach((archiveDate) => {
        archiveOptionsList.value.push({
            value: archiveDate.value,
            label: archiveDate.label
        })
    })
})

const selectedArchiveOption = ref(null)

watch(selectedArchiveOption, (value) => {
    if (value && value.value) {
        window.location.href = `/blog/archive/${value.value}`
    }
})
</script>
