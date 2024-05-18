<template>
    <aside class="aside">
        <SideBarLinks class="desktop__wrapper" />
    </aside>
</template>
<script setup>
import SideBarLinks from './SideBarLinks.vue'
</script>
<style scoped>
.aside {
    height: 100%;
}
.desktop__wrapper {
    display: flex;
    flex-direction: column;
    padding: 1rem 0;
    background-color: #fff;
    overflow-y: auto;
    width: 16rem;
    height: 100%;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

@media (max-width: 768px) {
    .desktop__wrapper,
    .aside {
        display: none;
    }
}
</style>
