<template>
    <div>
        <a href="#" class="btn btn__yellow btn__login" @click="openModal">
            Войти
        </a>
        <modal :show="showModal" @close="openModal">
            <div class="modal-header">
                <h2>Вход на сайт</h2>
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
            <div class="modal-body" v-if="stateRegister">
                <p class="modal__auth-desc">
                    Подарим подарок на день рождения, сохраним адрес доставки и
                    расскажем об акциях
                </p>
                <input
                    type="text"
                    class="form__control"
                    placeholder="Номер мобильного телефона"
                    v-model="phoneMasked"
                    v-maska="phone"
                    data-maska="['+7 (###) ###-##-##']"
                />
                <span
                    class="form__error"
                    v-if="errorsForm.hasOwnProperty('phone')"
                >
                    {{ errorsForm.phone[0] }}
                </span>
                <button
                    @click="telegramAuth"
                    class="btn btn__yellow btn__auth"
                    :disabled="!phone.completed"
                >
                    Войти
                </button>
            </div>
            <div class="modal-body" v-else>
                <p class="modal__auth-desc">
                    Подарим подарок на день рождения, сохраним адрес доставки и
                    расскажем об акциях
                </p>
                <input
                    type="text"
                    class="form__control"
                    placeholder="Код подтверждения"
                    v-maska="code"
                    data-maska="['###-###']"
                />
                <span
                    class="form__error"
                    v-if="errorsForm.hasOwnProperty('code')"
                >
                    {{ errorsForm.code[0] }}
                </span>
                <a
                    :href="`https://t.me/bcryptebot?start=${phone.unmasked}`"
                    class="link"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Перейти в Telegram
                </a>
                <button
                    @click="telegramAuth"
                    class="btn btn__yellow btn__auth"
                    :disabled="!code.completed"
                >
                    Войти
                </button>
            </div>
        </modal>
    </div>
</template>
<script setup>
import { vMaska } from 'maska'
import { reactive, ref } from 'vue'
import Modal from '~/components/Modal'
import api from '~/api'
import { useRoute, useRouter } from 'vue-router'

const showModal = ref(false)
const phone = reactive({})
const code = reactive({})
const stateRegister = ref(true)
const phoneMasked = ref('+7 ')
const errorsForm = ref([])

const { next } = useRouter()
const route = useRoute()

const openModal = () => {
    showModal.value = !showModal.value

    stateRegister.value = true
    errorsForm.value = []
}

const telegramAuth = async () => {
    try {
        const { data } = await api.post('telegram/login', {
            phone: phone.unmasked,
            code: code.masked,
        })
        if (data.token) {
            stateRegister.value = false

            userStore.saveToken(data.token)
            await userStore.fetchUser()

            if (route.name != 'index') {
                next({ name: 'index' })
            }
        }
    } catch ({ response }) {
        errorsForm.value = response.data.errors
    }
}
</script>
<style>
.modal {
    max-width: 410px;
    border-radius: 30px;
    padding: 30px;
}
</style>
<style scoped>
.form__control {
    margin-top: 15px;
}
.modal-body {
    display: flex;
    gap: 20px;
    flex-direction: column;
}
.form__control {
    padding: 17px 20px;
    font-size: 18px;
}
.btn__auth {
    padding: 13px !important;
    font-size: 18px;
}
.modal__auth-desc {
    font-weight: 500;
    color: rgb(92, 99, 112);
    margin-top: 10px;
}
</style>
