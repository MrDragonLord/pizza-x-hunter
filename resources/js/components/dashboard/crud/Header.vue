<template>
    <header>
        <h2>{{ title }}</h2>
        <div class="crud__actions">
            <Button
                @click="emit('create')"
                class="btn btn__primary"
                v-if="showCreate"
            >
                Создать
            </Button>
            <Button
                @click="emit('exportToExcel')"
                class="btn btn__success"
                v-if="showExportExcel"
            >
                Экспорт в Excel
            </Button>
        </div>
    </header>
</template>
<script setup>
import Button from '~/components/UI/Button.vue'

defineProps({
    title: String,
    showCreate: Boolean,
    showExportExcel: Boolean,
})
const emit = defineEmits(['create', 'exportToExcel'])
</script>
<style>
header {
    display: flex;
    justify-content: space-between;
}

.crud__actions {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 10px 20px;
}

h2 {
    font-size: 1.5rem;
    font-weight: 700;
}
</style>
