<template>
    <div class="stories__block">
        <swiper
            class="stories__section"
            :slides-per-view="8"
            :space-between="20"
            :simulateTouch="false"
            :loop="false"
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
        <button class="btn btn__arrow">
            <img src="@img/icons/arrow-right.svg" alt="Вправо" />
        </button>
    </div>
</template>
<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/scss'
</script>
