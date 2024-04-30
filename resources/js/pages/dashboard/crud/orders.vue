<template>
    <div>
        <CrudHeader
            title="Заказы"
            :showCreate="true"
            :showExportExcel="true"
            @create="openModal"
            @exportToExcel="openExcelModal"
        />
        <DataTable
            :value="items"
            @editFunction="editItem"
            @deleteFunction="deleteItem"
            v-if="!loading"
        >
            <Column field="user.name" header="Клиент" />
            <Column field="user.phone" header="Телефон" />
            <Column field="address" header="Адрес" />
            <Column field="created_at" header="Дата" />
        </DataTable>
        <Loader v-else />
        <modal :show="showModal" @close="openModal">
            <div class="modal-header">
                <h3>
                    {{ editMode ? 'Обновление заказа' : 'Создать заказ' }}
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
                    <h5>Клиент</h5>
                    <VueSelect
                        v-model="form.user_id"
                        :options="users"
                        :reduce="user => user.id"
                        label="name"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('user_id')"
                        >{{ errorsForm.user_id[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Адрес</h5>
                    <textarea
                        class="mt-1 form-control"
                        placeholder="Адрес"
                        v-model="form.address"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('description')"
                        >{{ errorsForm.description[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Позиции</h5>
                    <VueSelect
                        v-model="form.positions"
                        :options="positions"
                        :reduce="position => position.id"
                        label="name"
                        multiple
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('positions')"
                        >{{ errorsForm.positions[0] }}</span
                    >
                </div>
            </div>
            <div class="modal-footer">
                <Button
                    @click="() => (editMode ? editItemClick() : createItem())"
                    class="btn btn__primary btn__create"
                    :busy="busy"
                >
                    {{ editMode ? 'Обновить заказ' : 'Добавить заказ' }}
                </Button>
            </div>
        </modal>
        <modal :show="showModalExcel" @close="openExcelModal">
            <div class="modal-header">
                <h3>Экспорт в Excel</h3>
                <button @click="openExcelModal">
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
                    <h5>Начальная дата</h5>
                    <Calendar
                        v-model:checkIn="dateStart"
                        v-model:checkOut="dateEnd"
                        :placeholder="{
                            checkIn: 'Начало',
                            checkOut: 'Окончание',
                        }"
                        class="mt-1 form-control"
                        Timezone="Europe/Ekaterinburg"
                    />
                </div>
            </div>
            <div class="modal-footer">
                <Button
                    @click="exportToExcel"
                    class="btn btn__primary btn__create"
                    :busy="busy"
                >
                    Сгенерировать отчет
                </Button>
            </div>
        </modal>
    </div>
</template>
<script setup>
import { ref, onMounted, watch } from 'vue'
import api from '~/api'

import DataTable from '~/components/dashboard/crud/DataTable'
import Column from '~/components/dashboard/crud/Column'
import CrudHeader from '~/components/dashboard/crud/Header'
import Modal from '~/components/Modal'
import Button from '~/components/UI/Button'
import Loader from '~/components/UI/Loader'
import { useRoute } from 'vue-router'
import Swal from 'sweetalert2'
import VueSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import { Calendar } from 'vue-calendar-3'
import 'vue-calendar3/style'

const items = ref([])
const users = ref([])
const positions = ref([])
const form = ref({
    address: '',
    user_id: null,
    positions: [],
})
const errorsForm = ref([])

const busy = ref(false)
const loading = ref(true)
const showModal = ref(false)
const showModalExcel = ref(false)

const editMode = ref(false)

const linkPrefix = 'orders'
const router = useRoute()

const dateStart = ref(null)
const dateEnd = ref(null)

const currentPage = ref(+router.params.page || 1)

const formatter = new Intl.DateTimeFormat('ru')

const exportToExcel = async () => {
    busy.value = true
    try {
        const { data, headers } = await api.get(
            `/dashboard/${linkPrefix}/excel`,
            {
                responseType: 'blob',
                params: {
                    dateStart: formatter.format(dateStart.value),
                    dateEnd: formatter.format(dateEnd.value),
                },
            },
        )
        const href = window.URL.createObjectURL(data)

        const anchorElement = document.createElement('a')

        anchorElement.href = href
        anchorElement.download = 'Заказы.xlsx'

        document.body.appendChild(anchorElement)
        anchorElement.click()

        document.body.removeChild(anchorElement)
        window.URL.revokeObjectURL(href)
    } catch (error) {
    } finally {
        busy.value = false
    }
}

const openModal = () => {
    showModal.value = !showModal.value

    errorsForm.value = []
    form.value = {}
    editMode.value = false
}

const openExcelModal = () => {
    showModalExcel.value = !showModalExcel.value
}

const editItem = item => {
    openModal()
    editMode.value = true

    form.value = { ...item }
}

const deleteItem = item => {
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
        users.value = data.users
        positions.value = data.positions
        loading.value = false
    } catch (error) {}
}

const createItem = async () => {
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

const editItemClick = async () => {
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
