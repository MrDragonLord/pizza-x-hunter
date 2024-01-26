<template>
    <div class="dashboard">
        <sidemenu />
        <div class="dashboard__content">
            <vnavbar />
            <main class="dashboard__content">
                <router-view />
                <v-footer />
            </main>
        </div>
    </div>
</template>
<script>
    import sidemenu from '~/components/dashboard/sidemenu'
    import VFooter from '~/components/dashboard/v-footer'
    import VNavbar from '~/components/dashboard/v-navbar'
    export default {
        components: { sidemenu, VFooter, VNavbar },

    }
</script>
<style>
    .dashboard {
        display: flex;
        height: 100vh;
    }
    .dashboard__content {
        width: 100%;
        flex: 1 1 0%;
        flex-direction: column;
        overflow-y: auto;
        height: 100%;
    }


</style>
