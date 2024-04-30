<template>
    <div class="table-cell">{{ header }}</div>
</template>

<script setup>
import { defineProps } from 'vue'
defineProps({
    header: String,
})
</script>

<style scoped>
.table-cell {
    flex: 1;
    padding: 10px;
    border-bottom: 1px solid #e5e7eb;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 16px;
}
</style>
