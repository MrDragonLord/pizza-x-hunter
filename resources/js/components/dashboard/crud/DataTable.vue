<template>
    <div class="data-table" :style="tableStyle">
        <div class="table-header">
            <Column
                v-for="column in state.columns"
                :key="column.props.field"
                :header="column.props.header"
            />
            <Column header="Действия" />
        </div>
        <div class="table-body">
            <div v-if="value.length === 0" class="empty-message">
                Ничего не найдено
            </div>
            <div class="table-row" v-for="item in value" :key="item.id" v-else>
                <div
                    class="table-cell"
                    v-for="column in state.columns"
                    :key="column.props.field"
                >
                    {{ getValueByPath(item, column.props.field) }}
                </div>
                <div class="table-cell">
                    <button @click="editItem(item)" class="edit">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                            ></path>
                        </svg>
                    </button>
                    <button @click="deleteItem(item)" class="delete">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, toRaw, useSlots } from 'vue'
import Column from './Column'

const slots = useSlots()

const props = defineProps({
    value: Array,
    tableStyle: {
        type: String,
        default: '',
    },
})
const emit = defineEmits(['editFunction', 'deleteFunction'])

const state = reactive({
    columns: [],
})

onMounted(() => {
    if (slots.default) {
        state.columns = slots.default()
    }
})

function getValueByPath(item, path) {
    const segments = path.split('.')
    return segments.reduce((acc, segment) => {
        if (acc && segment in acc) {
            return acc[segment]
        }
        return undefined
    }, item)
}

const editItem = item => {
    emit('editFunction', toRaw(item))
}

const deleteItem = item => {
    emit('deleteFunction', toRaw(item))
}
</script>

<style scoped>
.data-table {
    display: flex;
    flex-direction: column;
    border-radius: 0.5rem;
    overflow: hidden;
    margin-top: 10px;
    padding: 10px;
    background-color: #fff;
    border-width: 1px;
    border-style: solid;
    border-color: #e5e7eb;
}

.table-header {
    display: flex;
}

.table-body {
    display: flex;
    flex-direction: column;
}

.table-row {
    display: flex;
}

.table-cell {
    flex: 1;
    padding: 10px;
}
.table-row + .table-row {
    border-top: 1px solid #e5e7eb;
}
.edit {
    color: rgb(37, 99, 235);
    background-color: transparent;
}
.delete {
    color: rgb(248, 113, 113);
    background-color: transparent;
}

.edit svg,
.delete svg {
    width: 1.25rem;
    height: 1.25rem;
}

.empty-message {
    padding: 20px;
    text-align: center;
    color: #64748b;
}
</style>
