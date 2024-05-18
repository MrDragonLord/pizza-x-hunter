<template>
    <ul class="user__profile">
        <li>
            <a href="#" class="user__profile-name link">
                <img
                    src="@img/icons/circle-user-regular.svg"
                    alt="Пользователь"
                />
                <div>
                    {{ user.name ? user.name : 'Пользователь' }}
                </div>
            </a>
        </li>
        <li>
            <button class="link" @click="logOutUser">Выйти</button>
        </li>
    </ul>
</template>
<script setup>
import { useRouter, useRoute } from 'vue-router'
import { useUserStore } from '~/store/user'

const { next } = useRouter()
const route = useRoute()

const { logOut, user } = useUserStore()

const logOutUser = async () => {
    await logOut()
    if (route.name != 'index') {
        next({ name: 'index' })
    }
}
</script>
<style scoped>
.link {
    font-size: 14px;
}
</style>
