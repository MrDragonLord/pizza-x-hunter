<template>
    <section id="positions">
        <div class="position" v-for="position in positions" :key="position.id">
            <img :src="position.img" :alt="position.name" />
            <div class="position__info">
                <h2>{{ position.name }}</h2>
                <p>
                    {{ position.description }}
                </p>
                <div class="position__footer">
                    <div class="position__footer-price">
                        от {{ position.price }} Р
                    </div>
                    <button class="btn btn__yellow">Выбрать</button>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import api from '~/api'

const positions = ref([])

onMounted(async () => {
    try {
        const { data } = await api.get('/main/positions')

        positions.value = data
    } catch (error) {}
})
</script>
