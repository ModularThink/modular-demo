<template>
    <p class="mt-5 mb-1">Category</p>
    <AppCombobox
        v-model="postStore.post.blog_category_id"
        :options="categories"
        combo-label="Select a Category"
        class="w-64 xl:w-full"
    />
</template>

<script setup>
import { onMounted } from 'vue'
import { usePostStore } from '../PostStore'
const postStore = usePostStore()

const props = defineProps({
    categories: {
        type: Object,
        default: () => {}
    }
})

onMounted(() => {
    if (postStore.post.blog_category_id) {
        postStore.post.blog_category_id = props.categories.find(
            (category) => category.value === postStore.post.blog_category_id
        )
    }
})
</script>
