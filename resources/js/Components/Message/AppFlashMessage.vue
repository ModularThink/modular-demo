<template>
    <AppToast ref="toastRef">
        <div :class="type" class="alert">
            <div class="flex align-middle">
                <i :class="iconClass" class="mr-2"></i>
                <span class="">{{ message }}</span>
            </div>
            <AppButton
                class="text-neutral-3 hover:text-neutral-4"
                @click="closeToast"
            >
                <i class="ri-close-circle-line text-lg"></i>
            </AppButton>
        </div>
    </AppToast>
</template>

<script setup>
import { ref, computed, watch, inject, onMounted, onUnmounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

const flash = computed(() => usePage().props.flash)
const translate = inject('translate')

const iconClass = ref(null)
const message = ref(null)
const type = ref(null)

const toastRef = ref(null)

let isRequestFromHistory = false

const popStateListener = () => {
    isRequestFromHistory = true
}

onMounted(() => {
    window.addEventListener('popstate', popStateListener)
})

onUnmounted(() => {
    window.removeEventListener('popstate', popStateListener)
})

watch(flash, (newFlash) => {
    //prevents toast from showing again when user navigates back
    if (isRequestFromHistory) {
        isRequestFromHistory = false
        return
    }

    if (newFlash.success) {
        type.value = 'success'
        message.value = translate(newFlash.success)
        iconClass.value = 'ri-check-line'
        toastRef.value.open()
    }

    if (newFlash.error) {
        type.value = 'error'
        message.value = translate(newFlash.error)
        iconClass.value = 'ri-alert-line'
        toastRef.value.open()
    }
})

const closeToast = () => {
    toastRef.value.close()
}
</script>

<style scoped>
@reference "../../../css/app.css";

.alert {
    @apply flex w-80 justify-between rounded-lg px-4 py-3 align-middle shadow;
}

.success {
    @apply bg-success text-success-light;
}

.error {
    @apply bg-error text-error-light;
}
</style>
