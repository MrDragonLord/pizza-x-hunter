<template>
    <div class="page-loader-wrapper">
        <div class="page-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</template>
<script></script>
<style scoped>
.page-loader-wrapper {
    display: flex;
    justify-content: center;
}

.page-enter-active,
.page-leave-active {
    transition: opacity 0.3s;
}
.page-enter,
.page-leave-to {
    opacity: 0;
}
.page-loader {
    display: inline-block;
    position: relative;
    width: 60px;
    height: 60px;
}
.page-loader div {
    animation: page-loader 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    transform-origin: 40px 40px;
}
@keyframes page-loader {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
.page-loader div:after {
    content: ' ';
    display: block;
    position: absolute;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background-color: #3b82f6;
    margin: -4px 0 0 -4px;
}
.page-loader div:nth-child(1) {
    animation-delay: -0.036s;
}
.page-loader div:nth-child(1):after {
    top: 63px;
    left: 63px;
}
.page-loader div:nth-child(2) {
    animation-delay: -0.072s;
}
.page-loader div:nth-child(2):after {
    top: 68px;
    left: 56px;
}
.page-loader div:nth-child(3) {
    animation-delay: -0.108s;
}
.page-loader div:nth-child(3):after {
    top: 71px;
    left: 48px;
}
.page-loader div:nth-child(4) {
    animation-delay: -0.144s;
}
.page-loader div:nth-child(4):after {
    top: 72px;
    left: 40px;
}
.page-loader div:nth-child(5) {
    animation-delay: -0.18s;
}
.page-loader div:nth-child(5):after {
    top: 71px;
    left: 32px;
}
.page-loader div:nth-child(6) {
    animation-delay: -0.216s;
}
.page-loader div:nth-child(6):after {
    top: 68px;
    left: 24px;
}
.page-loader div:nth-child(7) {
    animation-delay: -0.252s;
}
.page-loader div:nth-child(7):after {
    top: 63px;
    left: 17px;
}
.page-loader div:nth-child(8) {
    animation-delay: -0.288s;
}
.page-loader div:nth-child(8):after {
    top: 56px;
    left: 12px;
}
</style>
