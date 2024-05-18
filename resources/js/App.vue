<template>
    <router-view />
</template>
<script setup>
import { useUserStore } from './store/user'

const token = localStorage.getItem('api-token')

if (token) useUserStore().fetchUser()
</script>
