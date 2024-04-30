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
            :value="items"
            @editFunction="editItem"
            @deleteFunction="deleteItem"
            v-if="!loading"
        >
            <Column field="name" header="Фамилия Имя" />
            <Column field="phone" header="Телефон" />
            <Column field="role_name" header="Должность" />
        </DataTable>
        <Loader v-else />
        <modal :show="showModal" @close="openModal">
            <div class="modal-header">
                <h3>
                    {{
                        editMode
                            ? 'Обновление сотрудника'
                            : 'Создать сотрудника'
                    }}
                </h3>
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
                        <option
                            v-for="role in (index, roles)"
                            :value="role.id"
                            :key="role.id"
                            :selected="form.role_id === role.id"
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
                <Button
                    @click="() => (editMode ? editUser() : createUser())"
                    class="btn btn__primary btn__create"
                    :busy="busy"
                >
                    {{
                        editMode
                            ? 'Обновить сотрудника'
                            : 'Добавить нового сотрудника'
                    }}
                </Button>
            </div>
        </modal>
    </div>
</template>
<script setup>
import { ref, onMounted, watch } from 'vue'
import api from '~/api'

import { useUserStore } from '~/store/user'
import DataTable from '~/components/dashboard/crud/DataTable'
import Column from '~/components/dashboard/crud/Column'
import CrudHeader from '~/components/dashboard/crud/Header'
import Modal from '~/components/Modal'
import Button from '~/components/UI/Button'
import Loader from '~/components/UI/Loader'
import Swal from 'sweetalert2'

import { useRoute } from 'vue-router'

const items = ref([])
const roles = ref([])
const form = ref({
    name: '',
    email: '',
    phone: '',
    role_id: 0,
    password: '',
})
const errorsForm = ref([])

const busy = ref(false)
const loading = ref(true)
const showModal = ref(false)
const editMode = ref(false)

const linkPrefix = 'users'

const userStore = useUserStore()
const router = useRoute()

const currentPage = ref(+router.params.page || 1)

const exportToExcel = () => {}

const openModal = () => {
    showModal.value = !showModal.value

    errorsForm.value = []
    form.value = {}
    editMode.value = false
}

const editItem = item => {
    openModal()
    editMode.value = true

    form.value = { ...item }
}

const deleteItem = item => {
    if (userStore.user.id == item.id) {
        Swal.fire('Вы не можете удалить самого себя!', '', 'error')
        return
    }
    Swal.fire({
        title: 'Вы уверены, что хотите удалить?',
        showCancelButton: true,
        cancelButtonText: 'Отменить',
    }).then(async result => {
        if (result.isConfirmed) {
            await api.delete(`/dashboard/${linkPrefix}/delete/${item.id}`)

            Swal.fire('Успешно удалено!', '', 'success')

            await fetchItems()
        }
    })
}

const fetchItems = async () => {
    loading.value = true
    try {
        const { data } = await api.get(
            `/dashboard/${linkPrefix}/render?page=${currentPage.value}`,
        )
        data.value = data
        items.value = data.items
        roles.value = data.roles
        loading.value = false
    } catch (error) {}
}

const createUser = async () => {
    busy.value = true
    try {
        await api.post(`/dashboard/${linkPrefix}/create`, form.value)
        await fetchItems()
        openModal()
    } catch ({ response }) {
        errorsForm.value = response.data.errors
    } finally {
        busy.value = false
    }
}

const editUser = async () => {
    busy.value = true
    try {
        await api.post(
            `/dashboard/${linkPrefix}/update/` + form.value.id,
            form.value,
        )
        await fetchItems()
        openModal()
    } catch ({ response }) {
        errorsForm.value = response.data.errors
    } finally {
        busy.value = false
    }
}

onMounted(async () => {
    await fetchItems()
})
watch(
    () => currentPage.value,
    async () => {
        await fetchItems()
    },
)
</script>
