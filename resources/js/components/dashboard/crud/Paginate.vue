<template>
    <BasicPagination
        :page-count="totalRows"
        :page-range="5"
        :margin-pages="10"
        @pageSelected="navigatePage"
        container-class="paginate"
        page-class="btn"
        active-class="btn__primary"
    >
        <template v-slot:pageContent="slotProps">
            <router-link
                :to="{ name: '', params: { page: slotProps.pageNumber } }"
            >
                {{ slotProps.pageNumber }}
            </router-link>
        </template>
        <template v-slot:currentPageContent="slotProps">
            <router-link
                :to="{ name: '', params: { page: slotProps.pageNumber } }"
            >
                {{ slotProps.pageNumber }}
            </router-link>
        </template>
    </BasicPagination>
</template>
<script setup>
import 'vue3-basic-pagination/styles'
import { useRoute, useRouter } from 'vue-router'

const props = defineProps({
    totalRows: Number,
    perPage: Number,
    limit: Number,
})

const currentPage = defineModel()
const router = useRouter()

const navigatePage = pageIndex => {
    router.push({
        name: router.name,
        params: { page: (currentPage.value = pageIndex) },
    })
}
</script>
