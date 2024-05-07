<template>
    <div>
        <NavBar />
        <v-Header />
        <main class="container">
            <router-view />
        </main>
        <v-Footer />
    </div>
</template>
<script setup>
import NavBar from '~/components/Main/NavBar'
import VHeader from '~/components/Main/Header'
import VFooter from '~/components/Main/Footer'
import '@css/main'
</script>
