<template>
    <div class="stories__block">
        <swiper
            class="stories__section"
            ref="swiperRef"
            @swiper="onSwiper"
            :modules="[Navigation]"
            :simulateTouch="false"
            :loop="false"
            :breakpoints="breakpoints"
        >
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="stories__img">
                    <img src="@img/story__1.webp" alt="stories_1" />
                </div>
            </swiper-slide>
        </swiper>
        <button class="btn btn__arrow" @click="swiperNextSlide">
            <img src="@img/icons/arrow-right.svg" alt="Вправо" />
        </button>
    </div>
</template>
<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation } from 'swiper/modules'
import { ref } from 'vue'
import 'swiper/scss'

const swiperInstance = ref()
const breakpoints = ref({
    0: {
        simulateTouch: true,
        slidesPerView: 4,
        spaceBetween: 10,
    },
    500: {
        slidesPerView: 6,
    },
    721: {
        slidesPerView: 6,
        spaceBetween: 10,
    },
    1280: {
        simulateTouch: false,
        slidesPerView: 8,
        spaceBetween: 8,
    },
})
function onSwiper(swiper) {
    swiperInstance.value = swiper
}
const swiperNextSlide = () => {
    swiperInstance.value.slideNext()
}
</script>
