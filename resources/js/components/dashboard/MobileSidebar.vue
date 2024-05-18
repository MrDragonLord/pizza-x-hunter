<template>
    <div class="mobile__wrapper">
        <header class="header__wrapper">
            <div class="container header__content">
                <button @click="openMenu" class="btn btn__link">
                    <svg
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        class="w-6 h-6"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </div>
        </header>
        <div class="aside__overlay" v-if="open"></div>
        <aside v-if="open" class="aside__mobile">
            <SideBarLinks class="aside__container" />
        </aside>
    </div>
</template>
<script setup>
import { ref, watch } from 'vue'
import SideBarLinks from './SideBarLinks.vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const open = ref(false)

const openMenu = () => {
    open.value = !open.value
}

watch(
    () => route.name,
    () => {
        open.value = false
    },
)
</script>
<style scoped>
.mobile__wrapper {
    width: 100%;
    display: flex;
    flex-direction: column;
}
@media (min-width: 768px) {
    .mobile__wrapper {
        display: none;
    }
}
.header__wrapper {
    position: relative;
    background: #fff;
    padding: 1rem 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
    z-index: 10;
}
.header__content {
    display: flex;
    align-items: center;
    height: 100%;
    width: 100%;
}
.btn__link {
    padding: 0;
    color: #3b82f6;
    background-color: transparent;
    border-radius: 0.375rem;
}
.btn__link svg {
    width: 1.5rem;
    height: 1.5rem;
}
.aside__overlay {
    position: fixed;
    inset: 0;
    z-index: 9;
    background: rgba(0, 0, 0, 0.5);
}
.aside__mobile {
    position: fixed;
    top: 0;
    bottom: 0;
    overflow-y: auto;
    background-color: #fff;
    width: 16rem;
    margin-top: 3.7rem;
    z-index: 20;
}
.aside__container {
    padding: 1rem 0;
}
</style>
