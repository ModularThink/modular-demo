<template>
    <AppSectionHeader title="Blogs" :bread-crumb="breadCrumb">
        <AppButton
            v-if="can(isCreate ? 'Blog: Post - Create' : 'Blog: Post - Edit')"
            class="btn btn-primary mt-6"
            @click="submitForm"
        >
            Save
        </AppButton>
    </AppSectionHeader>

    <div class="flex flex-col xl:flex-row">
        <AppCard class="w-full xl:w-8/12">
            <template #title> {{ title }} </template>
            <template #content>
                <AppFormErrors class="mb-4" />
                <form class="pt-4">
                    <PostBody />

                    <PostImage />

                    <PostSeo />
                </form>
            </template>
        </AppCard>

        <AppCard class="mt-4 w-full xl:mt-0 xl:ml-5 xl:w-4/12">
            <template #title> Post Info </template>
            <template #content>
                <PostPublishDate />

                <PostCategory :categories="categories" />

                <PostTags :tags="tags" />

                <PostAuthor :authors="authors" />
            </template>
        </AppCard>
    </div>

    <AppButton
        v-if="can(isCreate ? 'Blog: Post - Create' : 'Blog: Post - Edit')"
        class="btn btn-primary mt-6"
        @click="submitForm"
    >
        Save
    </AppButton>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import useAuthCan from '@/Composables/useAuthCan'

import { onUnmounted } from 'vue'

import useTitle from '@/Composables/useTitle'
import useFormContext from '@/Composables/useFormContext'
import PostBody from './Components/PostBody.vue'
import PostImage from './Components/PostImage.vue'
import PostSeo from './Components/PostSeo.vue'
import PostPublishDate from './Components/PostPublishDate.vue'
import PostCategory from './Components/PostCategory.vue'
import PostTags from './Components/PostTags.vue'
import PostAuthor from './Components/PostAuthor.vue'
import { usePostStore } from './PostStore'

const postStore = usePostStore()
const { can } = useAuthCan()

const props = defineProps({
    post: {
        type: Object,
        default: null
    },

    categories: {
        type: Object,
        default: () => {}
    },

    tags: {
        type: Object,
        default: () => {}
    },

    authors: {
        type: Object,
        default: () => {}
    }
})

if (props.post) {
    postStore.setPost(props.post)
}

onUnmounted(() => {
    postStore.$reset()
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Posts', href: route('blogPost.index') },
    { label: 'Post', last: true }
]

const { title } = useTitle('Blog Post')
const { isCreate } = useFormContext()

const getValueFromKey = (data, key) => {
    return data[key] ? data[key].value : null
}

const submitForm = () => {
    const form = useForm(postStore.post)

    const postData = (data) => {
        const commonData = {
            ...data,
            blog_category_id: getValueFromKey(data, 'blog_category_id'),
            blog_author_id: getValueFromKey(data, 'blog_author_id')
        }

        return isCreate.value ? commonData : { ...commonData, _method: 'PUT' }
    }

    if (isCreate.value) {
        form.transform(postData).post(route('blogPost.store'))
    } else {
        form.transform(postData).post(route('blogPost.update', props.post.id))
    }
}
</script>
