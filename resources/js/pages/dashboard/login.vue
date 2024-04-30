<template>
    <div class="login">
        <div class="card">
            <h3>Авторизация</h3>
            <div class="form">
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Email"
                    class="form-control"
                />
                <span
                    class="form-error"
                    v-if="errorsForm.hasOwnProperty('email')"
                    >{{ errorsForm.email[0] }}</span
                >
                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Пароль"
                    class="form-control"
                />
                <span
                    class="form-error"
                    v-if="errorsForm.hasOwnProperty('password')"
                    >{{ errorsForm.password[0] }}</span
                >
                <Button :busy="busy" @click="login" class="btn btn__primary">
                    Войти
                </Button>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '~/api'
import Button from '~/components/UI/Button.vue'
import { useUserStore } from '~/store/user'

const form = ref({
    email: '',
    password: '',
})
const busy = ref(false)
const errorsForm = ref([])
const router = useRouter()
const userStore = useUserStore()

const login = async () => {
    busy.value = true
    try {
        const { data } = await api.post('/dashboard/login', form.value)
        userStore.saveToken(data.token)
        await userStore.fetchUser()

        router.push('/dashboard/home')
    } catch ({ response }) {
        errorsForm.value = response.data.errors
    } finally {
        busy.value = false
    }
}
</script>
<style>
.login {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    width: 560px;
    padding: 20px;
    text-align: center;
}

.form {
    display: flex;
    flex-direction: column;
    text-align: left;
    gap: 10px;
    margin-top: 15px;
}

.btn {
    text-transform: uppercase;
    margin-top: 10px;
}
</style>
