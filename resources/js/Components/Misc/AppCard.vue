<template>
    <div class="bg-neutral-2 mt-4 rounded-md shadow-sm">
        <div class="bg-neutral-3 rounded-t-md px-4 py-2">
            <h3 class="text-xl font-semibold tracking-tight">
                <slot name="title"> </slot>
            </h3>

            <slot name="description"> </slot>
        </div>

        <div class="p-4">
            <slot name="content"></slot>
        </div>

        <div v-if="$slots.footer" class="px-4 py-2 pb-4">
            <slot name="footer"></slot>
        </div>
    </div>
</template>
