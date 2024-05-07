<template>
    <div class="dashboard">
        <sidemenu />
        <div class="dashboard__content container">
            <main class="dashboard__content">
                <router-view />
            </main>
            <v-footer />
        </div>
    </div>
</template>
<script setup>
import sidemenu from '~/components/dashboard/sidemenu'
import VFooter from '~/components/dashboard/v-footer'
import '@css/dashboard'
</script>
<style>
.dashboard {
    display: flex;
    height: 100vh;
}
.dashboard__content {
    display: flex;
    width: 100%;
    flex: 1 1 0%;
    flex-direction: column;
    overflow-y: auto;
    height: 100%;
    padding: 30px 0;
}
</style>
