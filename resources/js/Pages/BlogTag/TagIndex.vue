<template>
    <AppSectionHeader title="Tags" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                v-if="can('Blog: Tag - Create')"
                class="btn btn-primary"
                @click="$inertia.visit(route('blogTag.create'))"
            >
                Create Tag
            </AppButton>
        </template>
    </AppSectionHeader>

    <AppDataSearch
        v-if="tags.data.length || route().params.searchTerm"
        :url="route('blogTag.index')"
        fields-to-search="name"
    ></AppDataSearch>

    <AppDataTable v-if="tags.data.length" :headers="headers">
        <template #TableBody>
            <tbody>
                <AppDataTableRow v-for="item in tags.data" :key="item.id">
                    <AppDataTableData>
                        {{ item.name }}
                    </AppDataTableData>

                    <AppDataTableData>
                        <!-- edit tag -->
                        <AppTooltip
                            v-if="can('Blog: Tag - Edit')"
                            text="Edit Tag"
                            class="mr-3"
                        >
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('blogTag.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-edit-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- delete tag -->
                        <AppTooltip
                            v-if="can('Blog: Tag - Delete')"
                            text="Delete Tag"
                        >
                            <AppButton
                                class="btn btn-icon btn-destructive"
                                @click="
                                    confirmDelete(
                                        route('blogTag.destroy', item.id)
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
        :links="tags.links"
        :from="tags.from || 0"
        :to="tags.to || 0"
        :total="tags.total || 0"
        class="mt-4 justify-center"
    ></AppPaginator>

    <AppAlert v-if="!tags.data.length" class="mt-4"> No tags found. </AppAlert>

    <AppConfirmDialog ref="confirmDialogRef"></AppConfirmDialog>
</template>

<script setup>
import { ref } from 'vue'
import useAuthCan from '@/Composables/useAuthCan'

defineProps({
    tags: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Tags', last: true }
]

const headers = ['Name', 'Actions']

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}

const { can } = useAuthCan()
</script>
