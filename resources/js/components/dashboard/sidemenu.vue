<template>
    <aside>
        <router-link to="dashboard" class="dashboard__logo aside__link">Pizza x Hunter</router-link>
        <ul class="aside__links">
            <li class="aside__link">
                <span v-if="$route.name == 'dashboard.users'" class="aside__link_active"></span>
                <router-link to="/dashboard/users" exact-active-class="active__link">Пользователи</router-link>
            </li>
            <li class="aside__link">
                <span v-if="$route.name == 'dashboard.orders'" class="aside__link_active"></span>
                <router-link to="/dashboard/orders" exact-active-class="active__link">Заказы</router-link>
            </li>
            <li class="aside__link">
                <span v-if="$route.name == 'dashboard.promos'" class="aside__link_active"></span>
                <router-link to="/dashboard/promos" exact-active-class="active__link">Акции</router-link>
            </li>
        </ul>
    </aside>
</template>
<script>
export default {

}
</script>
<style>
    aside {
        padding: 1rem 0;
        background-color: #fff;
        overflow-y: auto;
        width: 16rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .dashboard__logo {
        font-size: 1.25rem;
        font-weight: 700;
    }

    .aside__link {
        position: relative;
        padding: 0.75rem 1.5rem;
    }

    .aside__link a {
        font-weight: 700;
        font-size: .875rem;
    }

    .aside__link:hover,
    .aside__link .active__link {
        opacity: .75;
    }

    .aside__links {
        margin-top: 1.5rem;
    }

    .aside__link_active {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        border-bottom-right-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        background-color: rgb(37,99,235);
        width: 0.25rem;
    }
</style>
