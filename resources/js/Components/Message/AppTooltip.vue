<template>
    <div class="relative inline-block">
        <!-- Trigger -->
        <div @mouseover="showTooltip = true" @mouseout="showTooltip = false">
            <slot></slot>
        </div>

        <!-- Tooltip -->
        <transition name="fade">
            <div
                v-show="showTooltip"
                class="bg-neutral-10 text-neutral-1 absolute inline-flex rounded-sm p-2 text-xs transition-opacity duration-500 ease-in-out"
                :class="tooltipClass"
                :style="tooltipStyle"
            >
                {{ text }}
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const showTooltip = ref(false)

// Props
const props = defineProps({
    text: {
        type: String,
        required: true
    },
    position: {
        type: String,
        default: 'top'
    }
})

const tooltipClass = computed(() => {
    switch (props.position) {
        case 'top':
            return 'tooltip-top'
        case 'bottom':
            return 'tooltip-bottom'
        case 'left':
            return 'tooltip-left'
        case 'right':
            return 'tooltip-right'
        default:
            return 'tooltip-top'
    }
})

const tooltipStyle = ref({
    width: 'max-content'
})
</script>

<style scoped>
@reference "../../../css/app.css";

.tooltip-top {
    @apply bottom-full left-1/2 -translate-x-1/2 -translate-y-[5px] transform;
}

.tooltip-bottom {
    @apply top-full left-1/2 -translate-x-1/2 translate-y-[5px] transform;
}

.tooltip-left {
    @apply top-1/2 right-full -translate-x-[5px] -translate-y-1/2 transform;
}

.tooltip-right {
    @apply top-1/2 left-full -translate-y-1/2 translate-x-[5px] transform;
}

/* Arrows */
.tooltip-top::before,
.tooltip-bottom::before,
.tooltip-left::before,
.tooltip-right::before {
    @apply absolute border-solid content-[''];
}

.tooltip-top::before {
    @apply border-t-neutral-9 -bottom-[5px] left-1/2 -translate-x-1/2 transform border-t-[5px] border-r-[5px] border-b-0 border-l-[5px] border-r-transparent border-b-transparent border-l-transparent;
}

.tooltip-bottom::before {
    @apply border-b-neutral-9 -top-[5px] left-1/2 -translate-x-1/2 transform border-t-0 border-r-[5px] border-b-[5px] border-l-[5px] border-t-transparent border-r-transparent border-l-transparent;
}

.tooltip-left::before {
    @apply border-l-neutral-9 top-1/2 -right-[5px] -translate-y-1/2 transform border-t-[5px] border-r-0 border-b-[5px] border-l-[5px] border-t-transparent border-r-transparent border-b-transparent;
}

.tooltip-right::before {
    @apply border-r-neutral-9 top-1/2 -left-[5px] -translate-y-1/2 transform border-t-[5px] border-r-[5px] border-b-[5px] border-l-0 border-t-transparent border-b-transparent border-l-transparent;
}

/* Tooltip Transition */
.fade-enter-active,
.fade-leave-active {
    @apply transition-opacity duration-500;
}

.fade-enter-from,
.fade-leave-to {
    @apply opacity-0;
}
</style>
