<template>
    <div class="mt-5">
        <AppInputFile
            v-model="categoryStore.category.image"
            :image-preview-url="getImagePreviewURL()"
            @remove-file="categoryStore.category.remove_previous_image = true"
        ></AppInputFile>
    </div>
</template>

<script setup>
import useFormContext from '@/Composables/useFormContext'
import { useCategoryStore } from '../CategoryStore'

const categoryStore = useCategoryStore()

const { isCreate } = useFormContext()

const getImagePreviewURL = () => {
    if (!isCreate.value && categoryStore.category.image_url) {
        return categoryStore.category.image_url
    }

    return null
}
</script>
