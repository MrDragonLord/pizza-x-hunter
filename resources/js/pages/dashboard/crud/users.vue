<template>
    <div>
        <CrudHeader
            title="Сотрудники"
            :create="create"
            :exportToExcel="exportToExcel"
            :editFunction="edit"
            :deleteFunction="deleteItem"
        />
        <DataTable :value="users">
            <Column field="name" header="ФИО сотрудников" />
            <Column field="email" header="Email" />
            <Column field="role" header="Должность" />
        </DataTable>
    </div>
</template>
<script>
import DataTable from '~/components/dashboard/crud/DataTable.vue'
import CrudHeader from '~/components/dashboard/crud/Header'
import { ref } from 'vue'

export default {
    components: { CrudHeader, DataTable },
    setup() {
        const exportToExcel = () => {}

        const create = () => {}

        const users = ref([
            {
                id: 1,
                name: 'Озорнин Михаил',
                email: 'ozornim@gmail.com',
                role: 'Администратор',
            },
            {
                id: 2,
                name: 'Озорнин Михаил2',
                email: 'ozornim@gmail.com',
                role: 'Администратор',
            },
            {
                id: 3,
                name: 'Озорнин Михаил3',
                email: 'ozornim@gmail.com',
                role: 'Администратор',
            },
        ])

        const edit = item => {}

        const deleteItem = item => {}

        return {
            exportToExcel,
            create,
            edit,
            deleteItem,
            users,
        }
    },
}
</script>
