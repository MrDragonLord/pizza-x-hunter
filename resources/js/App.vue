<template>
    <div>
        <router-view />
    </div>
</template>
<script setup>
import { onMounted } from 'vue'
import { useUserStore } from '~/store/user'

const userStore = useUserStore()

onMounted(async () => {
    // try {
    //     await userStore.fetchUser()
    // } catch (error) {}
})
</script>
