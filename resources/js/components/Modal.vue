<template>
    <div v-if="show" class="overlay" @click="emit('close')">
        <div class="modal" @click.stop>
            <slot />
        </div>
    </div>
</template>

<script setup>
defineProps({
    show: Boolean,
})
const emit = defineEmits(['close'])
</script>

<style>
.overlay {
    position: fixed;
    z-index: 1000000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal {
    width: 720px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
}
.modal-body .description div {
    display: flex;
    padding: 5px 0px;
    width: 100%;
    border-bottom: 1px solid rgb(229, 231, 235);
}
.modal-body .description div:last-child {
    border: 0;
}
.modal-body .title {
    font-size: 20px;
    text-transform: uppercase;
    font-weight: bold;
}

.modal-footer {
    display: flex;
    align-items: center;
}
.modal-header {
    display: flex;
    justify-content: space-between;
}

.modal-header svg {
    height: 2rem;
    width: 2rem;
}

.modal-header button {
    background-color: transparent;
}
</style>
