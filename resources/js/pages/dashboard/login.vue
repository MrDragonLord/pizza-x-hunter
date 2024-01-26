<template>
    <div class="login">
        <div class="card">
            <h3>Авторизация</h3>
            <div class="form">
                <input
                    v-model="email"
                    type="email"
                    placeholder="Email"
                    class="form-control"
                />
                <input
                    v-model="password"
                    type="password"
                    placeholder="Пароль"
                    class="form-control"
                />
                <button @click="login" class="btn btn__primary">Войти</button>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'

export default {
    setup() {
        const email = ref('')
        const password = ref('')

        const router = useRouter()

        const login = () => {
            router.push('/dashboard')
        }

        return {
            email,
            password,
            login,
        }
    },
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
    gap: 10px;
    margin-top: 15px;
}

.btn {
    text-transform: uppercase;
    margin-top: 10px;
}
</style>
