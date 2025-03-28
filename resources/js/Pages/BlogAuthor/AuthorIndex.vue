<template>
    <AppSectionHeader title="Authors" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                v-if="can('Blog: Author - Create')"
                class="btn btn-primary"
                @click="$inertia.visit(route('blogAuthor.create'))"
            >
                Create Author
            </AppButton>
        </template>
    </AppSectionHeader>

    <AppDataSearch
        v-if="authors.data.length || route().params.searchTerm"
        :url="route('blogAuthor.index')"
        fields-to-search="name"
    ></AppDataSearch>

    <AppDataTable v-if="authors.data.length" :headers="headers">
        <template #TableBody>
            <tbody>
                <AppDataTableRow v-for="item in authors.data" :key="item.id">
                    <AppDataTableData>
                        <img
                            v-if="item.image_url"
                            :src="item.image_url"
                            class="h-10 w-10 rounded"
                        />

                        <AppImageNotAvailable v-else />
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.name }}<br />
                        <small class="text-neutral-9 text-sm">{{
                            item.email
                        }}</small>
                    </AppDataTableData>

                    <AppDataTableData>
                        <small class="text-neutral-9 text-sm">
                            <i class="ri-github-fill mr-0 h-5 w-5"></i>
                            {{ item.github_handle }}<br />
                            <i class="ri-twitter-x-line mr-1 h-5 w-5"></i
                            >{{ item.twitter_handle }}
                        </small>
                    </AppDataTableData>

                    <AppDataTableData>
                        <!-- edit author -->
                        <AppTooltip
                            v-if="can('Blog: Author - Edit')"
                            text="Edit Author"
                            class="mr-3"
                        >
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('blogAuthor.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-edit-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- delete author -->
                        <AppTooltip
                            v-if="can('Blog: Author - Delete')"
                            text="Delete Author"
                        >
                            <AppButton
                                class="btn btn-icon btn-destructive"
                                @click="
                                    confirmDelete(
                                        route('blogAuthor.destroy', item.id)
                                    )
                                "
                            >
                                <i class="ri-delete-bin-line"></i>
                            </AppButton>
                        </AppTooltip>
                    </AppDataTableData>
                </AppDataTableRow>
            </tbody>
        </template>
    </AppDataTable>

    <AppPaginator
        :links="authors.links"
        :from="authors.from || 0"
        :to="authors.to || 0"
        :total="authors.total || 0"
        class="mt-4 justify-center"
    ></AppPaginator>

    <AppAlert v-if="!authors.data.length" class="mt-4">
        No authors found.
    </AppAlert>

    <AppConfirmDialog ref="confirmDialogRef"></AppConfirmDialog>
</template>

<script setup>
import { ref } from 'vue'
import useAuthCan from '@/Composables/useAuthCan'
import AppImageNotAvailable from '@/Components/Modules/Blog/AppImageNotAvailable.vue'

defineProps({
    authors: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Authors', last: true }
]

const headers = ['Image', 'Name/Email', 'Social', 'Actions']

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}

const { can } = useAuthCan()
</script>
