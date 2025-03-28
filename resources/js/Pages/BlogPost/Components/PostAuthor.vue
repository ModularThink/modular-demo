<template>
    <p class="mt-5 mb-1">Author</p>
    <AppCombobox
        v-model="postStore.post.blog_author_id"
        :options="authors"
        combo-label="Select an Author"
        class="w-64 xl:w-full"
    />
</template>

<script setup>
import { onMounted } from 'vue'
import { usePostStore } from '../PostStore'
const postStore = usePostStore()

const props = defineProps({
    authors: {
        type: Object,
        default: () => {}
    }
})

onMounted(() => {
    if (postStore.post.blog_author_id) {
        postStore.post.blog_author_id = props.authors.find(
            (author) => author.value === postStore.post.blog_author_id
        )
    }
})
</script>
