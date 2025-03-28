<template>
    <div>
        <AppLabel for="title">Title</AppLabel>
        <AppInputText
            id="title"
            v-model="postStore.post.title"
            type="text"
            :class="{
                'input-error': errorsFields.includes('title')
            }"
        />
    </div>

    <div class="mt-5">
        <AppLabel for="notes">Content</AppLabel>
        <AppTipTapEditor
            v-model="postStore.post.content"
            editor-id="notes"
            :class="{
                'app-tip-tap-error': errorsFields.includes('content')
            }"
            :file-upload-url="route('blogPost.uploadEditorImage')"
        />
    </div>

    <div class="mt-5">
        <AppLabel for="notes">Summary</AppLabel>
        <AppTipTapEditor
            v-model="postStore.post.summary"
            editor-id="summary"
            :class="{
                'app-tip-tap-error': errorsFields.includes('summary')
            }"
            :file-upload-url="route('blogPost.uploadEditorImage')"
        />
    </div>
</template>

<script setup>
import useFormErrors from '@/Composables/useFormErrors'
import { usePostStore } from '../PostStore'
const postStore = usePostStore()
const { errorsFields } = useFormErrors()
</script>
