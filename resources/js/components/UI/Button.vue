<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    busy: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
})
</script>

<template>
    <button
        class="btn"
        :class="{ 'btn-loading': busy }"
        :disabled="props.disabled"
    >
        <slot />
    </button>
</template>

<style scoped>
.btn-loading {
    position: relative;
    pointer-events: none;
    color: transparent !important;
}

.btn-loading::after {
    content: '';
    position: absolute;
    display: block;
    border-radius: 50%;
    border-left: 2px;
    border-style: solid;
    border-color: #fff;
    border-right-color: transparent;
    border-top-color: transparent;
    height: 1em;
    width: 1em;
    left: calc(50% - (1em / 2));
    top: calc(50% - (1em / 2));
    animation: spinAround 500ms infinite linear;
}

@keyframes spinAround {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(359deg);
    }
}
</style>
