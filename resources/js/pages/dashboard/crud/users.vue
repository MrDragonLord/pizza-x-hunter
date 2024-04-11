<template>
    <div>
        <CrudHeader
            title="Сотрудники"
            :showCreate="true"
            :showExportExcel="false"
            @create="openModal"
            @exportToExcel="exportToExcel"
        />
        <DataTable
            :value="users"
            @editFunction="editItem"
            @deleteFunction="deleteItem"
        >
            <Column field="name" header="Фамилия Имя" />
            <Column field="phone" header="Телефон" />
            <Column field="role_name" header="Должность" />
        </DataTable>
        <modal :show="showModal">
            <div class="modal-header">
                <h3>Новый сотрудник</h3>
                <button @click="showModal = !showModal">
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
                    <h5>Фамилия Имя</h5>
                    <input
                        class="mt-1 form-control"
                        placeholder="Фамилия Имя"
                        v-model="form.name"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('name')"
                        >{{ errorsForm.name[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Email</h5>
                    <input
                        type="email"
                        class="mt-1 form-control"
                        placeholder="Email"
                        v-model="form.email"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('email')"
                        >{{ errorsForm.email[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Телефон</h5>
                    <input
                        class="mt-1 form-control"
                        placeholder="Название"
                        v-model="form.phone"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('phone')"
                        >{{ errorsForm.phone[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Должность</h5>
                    <select class="mt-1 form-control" v-model="form.role_id">
                        <option value="0" selected>Без должности</option>
                        <option
                            :value="role.id"
                            v-for="role in roles"
                            :key="role.id"
                        >
                            {{ role.name }}
                        </option>
                    </select>
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('role_id')"
                        >{{ errorsForm.role_id[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Пароль</h5>
                    <input
                        type="password"
                        class="mt-1 form-control"
                        placeholder="Пароль"
                        v-model="form.password"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('password')"
                        >{{ errorsForm.password[0] }}</span
                    >
                </div>
            </div>
            <div class="modal-footer">
                <button
                    @click="createUser"
                    class="btn btn__primary btn__create"
                >
                    Добавить нового сотрудника
                </button>
            </div>
        </modal>
    </div>
</template>
<script setup>
import DataTable from '~/components/dashboard/crud/DataTable.vue'
import CrudHeader from '~/components/dashboard/crud/Header'
import Modal from '~/components/Modal.vue'
import { ref, onMounted } from 'vue'
import api from '~/api'

const users = ref([])
const roles = ref([])
const form = ref({
    name: '',
    email: '',
    phone: '',
    role_id: 0,
    password: '',
})
const errorsForm = ref([])
const showModal = ref(false)

const exportToExcel = () => {}

const openModal = () => {
    showModal.value = !showModal.value
}

const editItem = item => {
    openModal()

    form.value = item
}

const deleteItem = item => {}

const fetchUsers = async () => {
    try {
        const { data } = await api.get('/dashboard/users/render')
        users.value = data.users.data
        roles.value = data.roles
    } catch (error) {}
}

const createUser = async () => {
    try {
        await api.post('/dashboard/users/create', form.value)
        await fetchUsers()
        openModal()
        form.value = {}
    } catch ({ response }) {
        errorsForm.value = response.data.errors
    }
}

onMounted(async () => {
    await fetchUsers()
})
</script>
