<template>
    <router-view />
</template>
<script setup>
import { useUserStore } from './store/user'

useUserStore().fetchUser()
</script>
