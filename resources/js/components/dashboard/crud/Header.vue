<template>
    <header>
        <h2>{{ title }}</h2>
        <div class="crud__actions">
            <button class="btn btn__primary" v-if="create">Создать</button>
            <button class="btn btn__success" v-if="exportToExcel">
                Экспорт в Excel
            </button>
        </div>
    </header>
</template>
<script>
export default {
    name: 'crud-header',
    props: ['title', 'create', 'exportToExcel'],
    setup() {},
}
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
