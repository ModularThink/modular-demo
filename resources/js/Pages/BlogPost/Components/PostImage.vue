<template>
    <div class="mt-5">
        <AppInputFile
            v-model="postStore.post.image"
            :image-preview-url="getImagePreviewURL()"
            @remove-file="postStore.post.remove_previous_image = true"
        ></AppInputFile>
    </div>
</template>

<script setup>
import useFormContext from '@/Composables/useFormContext'
import { usePostStore } from '../PostStore'

const postStore = usePostStore()

const { isCreate } = useFormContext()

const getImagePreviewURL = () => {
    if (!isCreate.value && postStore.post.image_url) {
        return postStore.post.image_url
    }

    return null
}
</script>
