<template>
    <div>
        <a href="#" class="btn btn__yellow btn__login" @click="openModal">
            Войти
        </a>
        <modal :show="showModal" @close="openModal">
            <div class="modal-header">
                <h3>Вход на сайт</h3>
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
        </modal>
    </div>
</template>
<script setup>
import Modal from '~/components/Modal'
import { ref } from 'vue'

const showModal = ref(false)
const form = ref({
    phone: '',
})
const errorsForm = ref([])

const openModal = () => {
    showModal.value = !showModal.value

    errorsForm.value = []
    form.value = {}
}
</script>
<style>
.modal {
    max-width: 410px;
}
</style>
