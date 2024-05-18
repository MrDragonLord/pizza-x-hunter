<template>
    <div>
        <router-link to="/dashboard/home" class="dashboard__logo aside__link">
            Pizza x Hunter
        </router-link>
        <ul class="aside__links">
            <li class="aside__link">
                <span
                    v-if="$route.name === 'dashboard'"
                    class="aside__link_active"
                />
                <router-link
                    to="/dashboard/home"
                    exact-active-class="active__link"
                >
                    Панель управления
                </router-link>
            </li>
            <li class="aside__link">
                <span
                    v-if="$route.name == 'dashboard.users'"
                    class="aside__link_active"
                />
                <router-link
                    to="/dashboard/users"
                    exact-active-class="active__link"
                >
                    Пользователи
                </router-link>
            </li>
            <li class="aside__link">
                <span
                    v-if="$route.name == 'dashboard.positions'"
                    class="aside__link_active"
                />
                <router-link
                    to="/dashboard/positions"
                    exact-active-class="active__link"
                    >Позиции</router-link
                >
            </li>
            <li class="aside__link">
                <span
                    v-if="$route.name == 'dashboard.orders'"
                    class="aside__link_active"
                />
                <router-link
                    to="/dashboard/orders"
                    exact-active-class="active__link"
                >
                    Заказы</router-link
                >
            </li>
        </ul>
        <div class="aside__profile">
            <div class="aside__name">
                <h3 class="aside__name">{{ user.name }}</h3>
            </div>
        </div>
        <div class="aside__logout">
            <a @click="logOutUser" class="link__router">Выйти</a>
        </div>
    </div>
</template>
<script setup>
import { useRouter } from 'vue-router'
import { useUserStore } from '~/store/user'

const { user, logOut } = useUserStore()
const router = useRouter()

const logOutUser = async () => {
    await logOut()
    router.push({ name: 'dashboard.login' })
}
</script>
