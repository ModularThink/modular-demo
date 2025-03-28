<template>
    <AppSectionHeader title="Authors" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <AppCard class="w-full md:w-3/4 xl:w-1/2">
        <template #title> {{ title }} </template>
        <template #content>
            <AppFormErrors class="mb-4" />
            <form class="pt-4">
                <div>
                    <AppLabel for="name">Name</AppLabel>
                    <AppInputText
                        id="name"
                        v-model="form.name"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('name')
                        }"
                        autocomplete="off"
                    />
                </div>

                <div class="mt-5">
                    <AppLabel for="bio">Bio</AppLabel>
                    <AppTipTapEditor
                        v-model="form.bio"
                        editor-id="bio"
                        :class="{
                            'app-tip-tap-error': errorsFields.includes('bio')
                        }"
                    />
                </div>

                <div class="mt-5">
                    <AppInputFile
                        v-model="form.image"
                        :image-preview-url="getImagePreviewURL()"
                        @remove-file="form.remove_previous_image = true"
                    ></AppInputFile>
                </div>

                <div class="mt-5">
                    <AppLabel for="email">Email</AppLabel>
                    <AppInputText
                        id="email"
                        v-model="form.email"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('email')
                        }"
                        autocomplete="off"
                    />
                </div>

                <div class="mt-5">
                    <AppLabel for="github-handle">Github</AppLabel>
                    <AppInputText
                        id="github-handle"
                        v-model="form.github_handle"
                        type="text"
                        :class="{
                            'input-error':
                                errorsFields.includes('github_handle')
                        }"
                    />
                </div>

                <div class="mt-5">
                    <AppLabel for="twitter-handle">Twitter</AppLabel>
                    <AppInputText
                        id="twitter-handle"
                        v-model="form.twitter_handle"
                        type="text"
                        :class="{
                            'input-error':
                                errorsFields.includes('twitter_handle')
                        }"
                    />
                </div>
            </form>
        </template>
        <template #footer>
            <AppButton
                v-if="
                    can(
                        isCreate
                            ? 'Blog: Author - Create'
                            : 'Blog: Author - Edit'
                    )
                "
                class="btn btn-primary"
                @click="submitForm"
            >
                {{ __('Save') }}
            </AppButton>
        </template>
    </AppCard>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import useAuthCan from '@/Composables/useAuthCan'

import useTitle from '@/Composables/useTitle'
import useFormContext from '@/Composables/useFormContext'
import useFormErrors from '@/Composables/useFormErrors'

const props = defineProps({
    author: {
        type: Object,
        default: null
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Authors', href: route('blogAuthor.index') },
    { label: 'Author', last: true }
]

const { title } = useTitle('Author')
const { isCreate } = useFormContext()
const { can } = useAuthCan()

const form = useForm({
    id: props.author ? props.author.id : null,

    name: props.author ? props.author.name : '',
    bio: props.author ? props.author.bio : '',
    email: props.author ? props.author.email : '',
    github_handle: props.author ? props.author.github_handle : '',
    twitter_handle: props.author ? props.author.twitter_handle : '',

    image: null,

    image_url: props.author ? props.author.image_url : null,

    remove_previous_image: false
})

const getImagePreviewURL = () => {
    if (!isCreate.value && form.image_url) {
        return form.image_url
    }

    return null
}

const submitForm = () => {
    if (isCreate.value) {
        form.post(route('blogAuthor.store'))
    } else {
        form.transform((data) => ({
            ...data,
            _method: 'PUT'
        })).post(route('blogAuthor.update', props.author.id))
    }
}

const { errorsFields } = useFormErrors()
</script>
