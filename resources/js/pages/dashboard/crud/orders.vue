<template>
    <div>
        <CrudHeader
            title="Позиции"
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
            <Column field="name" header="Название" />
            <Column field="price" header="Цена" />
            <Column field="weight" header="Вес" />
            <Column field="discount" header="Скидка" />
        </DataTable>
        <Loader v-else />
        <modal :show="showModal" @close="openModal">
            <div class="modal-header">
                <h3>
                    {{ editMode ? 'Обновление позиции' : 'Создать позицию' }}
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
                    <h5>Название</h5>
                    <input
                        type="text"
                        class="mt-1 form-control"
                        placeholder="Название"
                        v-model="form.name"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('name')"
                        >{{ errorsForm.name[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Описание</h5>
                    <textarea
                        class="mt-1 form-control"
                        placeholder="Описание"
                        v-model="form.description"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('description')"
                        >{{ errorsForm.description[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Цена</h5>
                    <input
                        type="number"
                        class="mt-1 form-control"
                        placeholder="Цена"
                        v-model.number="form.price"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('price')"
                        >{{ errorsForm.price[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Вес</h5>
                    <input
                        type="weight"
                        class="mt-1 form-control"
                        placeholder="Вес"
                        v-model.number="form.weight"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('weight')"
                        >{{ errorsForm.weight[0] }}</span
                    >
                </div>
                <div class="form-input">
                    <h5>Скидка</h5>
                    <input
                        type="weight"
                        class="mt-1 form-control"
                        placeholder="Скидка"
                        v-model.number="form.discount"
                    />
                    <span
                        class="form-error"
                        v-if="errorsForm.hasOwnProperty('discount')"
                        >{{ errorsForm.discount[0] }}</span
                    >
                </div>
            </div>
            <div class="modal-footer">
                <Button
                    @click="() => (editMode ? editItemClick() : createItem())"
                    class="btn btn__primary btn__create"
                    :busy="busy"
                >
                    {{ editMode ? 'Обновить позицию' : 'Добавить позицию' }}
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
import Swal from 'sweetalert2'

import { useRoute } from 'vue-router'

const items = ref([])
const form = ref({
    name: '',
    description: '',
    price: 0,
    weight: 0,
    discount: 0,
})
const errorsForm = ref([])

const busy = ref(false)
const loading = ref(true)
const showModal = ref(false)
const editMode = ref(false)

const linkPrefix = 'orders'
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
