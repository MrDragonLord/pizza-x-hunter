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
            <Column field="firstName" header="Фамилия" />
            <Column field="lastName" header="Имя" />
            <Column field="phone" header="Телефон" />
            <Column field="role" header="Должность" />
        </DataTable>
        <modal :show="showCreate">
            <div class="modal-header">
                <h3>Новый сотрудник</h3>
                <button @click="showCreate = !showCreate">
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
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-input">
                    <h5>Фамилия</h5>
                    <input class="mt-1 form-control" placeholder="Название" />
                    <span class="form-error">Типо ошибка</span>
                </div>
                <div class="form-input">
                    <h5>Имя</h5>
                    <input class="mt-1 form-control" placeholder="Название" />
                    <span class="form-error">Типо ошибка</span>
                </div>
                <div class="form-input">
                    <h5>Телефон</h5>
                    <input class="mt-1 form-control" placeholder="Название" />
                    <span class="form-error">Типо ошибка</span>
                </div>
                <div class="form-input">
                    <h5>Должность</h5>
                    <select class="mt-1 form-control" name="" id="">
                        <option value="">Администратор</option>
                        <option value="">Менеджер</option>
                    </select>
                    <span class="form-error">Типо ошибка</span>
                </div>
                <div class="form-input">
                    <h5>Пароль</h5>
                    <input
                        type="password"
                        class="mt-1 form-control"
                        placeholder="Название"
                    />
                    <span class="form-error">Типо ошибка</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn__primary btn__create">
                    Добавить нового сотрудника
                </button>
            </div>
        </modal>
        <modal :show="showEdit"> </modal>
    </div>
</template>
<script>
import DataTable from '~/components/dashboard/crud/DataTable.vue'
import CrudHeader from '~/components/dashboard/crud/Header'
import Modal from '~/components/Modal.vue'
import { ref } from 'vue'

export default {
    components: { CrudHeader, DataTable, Modal },
    setup() {
        const showCreate = ref(false)
        const showEdit = ref(false)

        const exportToExcel = () => {}

        const create = () => {
            showCreate.value = !showCreate.value
        }

        const users = ref([
            {
                id: 1,
                firstName: 'Озорнин',
                lastName: 'Михаил',
                phone: '+79058606069',
                role: 'Администратор',
            },
            {
                id: 2,
                firstName: 'Озорнин',
                lastName: 'Михаил',
                phone: '+79058606069',
                role: 'Администратор',
            },
            {
                id: 3,
                firstName: 'Озорнин',
                lastName: 'Михаил',
                phone: '+79058606069',
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
            showCreate,
            showEdit,
        }
    },
}
</script>
<style>
.modal-body {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.form-input {
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.btn__create {
    padding-left: 1rem;
    padding-right: 1rem;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    font-size: 12px;
    margin-top: 10px;
}
</style>
