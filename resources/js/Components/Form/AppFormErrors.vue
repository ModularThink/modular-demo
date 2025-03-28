<template>
    <div v-if="hasErrors">
        <div class="text-error font-medium">
            {{ __('Whoops! Something went wrong...') }}
        </div>

        <ul class="text-error mt-3 list-inside list-disc text-sm">
            <li v-for="(error, key) in errors" :key="key">{{ __(error) }}</li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const errors = computed(() => usePage().props.errors)

const hasErrors = computed(() => Object.keys(errors.value).length > 0)
</script>
