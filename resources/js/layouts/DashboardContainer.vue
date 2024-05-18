<template>
    <div class="dashboard">
        <DesktopSidebar />
        <MobileSidebar />
        <div class="dashboard__content container">
            <main class="dashboard__content">
                <router-view />
            </main>
            <v-footer />
        </div>
    </div>
</template>
<script setup>
import DesktopSidebar from '~/components/dashboard/DesktopSidebar'
import MobileSidebar from '~/components/dashboard/MobileSidebar'
import VFooter from '~/components/dashboard/v-footer'
import '@css/dashboard'
</script>
<style>
.dashboard {
    display: flex;
    height: 100vh;
}

@media (max-width: 768px) {
    .dashboard {
        flex-direction: column;
    }
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
