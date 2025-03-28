<template>
    <p class="mt-5 mb-1">Tag</p>
    <AppCombobox
        v-model="selectedTag"
        :options="tags"
        combo-label="Select a Tag"
        class="w-64 xl:w-full"
    />

    <ul class="mt-2">
        <li
            v-for="tag in postStore.post.tags"
            :key="tag.id"
            class="bg-neutral-3 mb-3 flex items-center justify-between rounded p-3"
        >
            <span>
                {{ tag.name }}
            </span>

            <i
                class="ri-close-line text-neutral-11 hover:text-neutral-12 hover:cursor-pointer"
                @click="removeTag(tag)"
            ></i>
        </li>
    </ul>
</template>

<script setup>
import { ref, watch } from 'vue'
import { usePostStore } from '../PostStore'

const postStore = usePostStore()

defineProps({
    tags: {
        type: Object,
        default: () => {}
    }
})

const selectedTag = ref(null)

const updateTagsStatus = () => {
    if (!postStore.tagsHasChanged) {
        postStore.post.tagsHasChanged = true
    }
}

watch(selectedTag, (value) => {
    if (!value) {
        return
    }

    const postTags = postStore.post.tags

    const tag = {
        id: value.value,
        name: value.label
    }

    if (!postTags.some((tag) => tag.id === value.value)) {
        postTags.push(tag)

        updateTagsStatus()
    }
})

const removeTag = (tag) => {
    const postTags = postStore.post.tags
    const index = postTags.indexOf(tag)

    postTags.splice(index, 1)

    updateTagsStatus()
}
</script>
