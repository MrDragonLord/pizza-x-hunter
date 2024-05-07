<template>
    <header class="container">
        <div class="about">
            <div class="about__info">
                <h1 class="logo">
                    <img src="@img/logo.svg" alt="Pizza x Hunter" />
                </h1>
                <div class="about__time">
                    Доставка <span>пиццы <br />45</span> минут
                </div>
            </div>
            <ModalAuth />
            <a href="#" class="btn btn__icon">
                <img src="@img/icons/align-justify.svg" alt="Menu" />
            </a>
        </div>
        <ul class="category">
            <li><a href="#">Пиццы</a></li>
            <li><a href="#">Комбо</a></li>
            <li><a href="#">Закуски и салаты</a></li>
            <li><a href="#">Напитки</a></li>
            <li><a href="#">Соусы</a></li>
            <li><a href="#">Акции</a></li>
        </ul>
        <Stories />
    </header>
</template>
<script setup>
import Stories from '~/components/Main/Header/Stories'
import ModalAuth from '~/components/Main/ModalAuth'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/scss'
</script>
