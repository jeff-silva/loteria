<template>
    <div>
        <div v-if="prices.length==0">
            No prices
        </div>

        <div class="container p-0 row">
            <div class="col" v-for="p in prices">
                <div class="card my-0 mx-auto text-center" :style="`height:100%; max-width:${cardMaxWidth};`">
                    <p class="ribbon ribbon-top-right" v-if="p.ribbon">
                        <span :style="`background:${p.backgroundColor}; color:${p.textColor};`">{{ p.ribbon }}</span>
                    </p>
                    <p class="py-4 text-uppercase fw-bold">{{ p.title }}</p>
                    <p class="d-flex justify-content-center align-text-top text-primary">
                        <span class=" fas fa-dollar-sign textmuted pe-1 h6 mt-2 m-0"></span>
                        <span class="h1 m-0">{{ p.price }}</span>
                    </p>
                    <p class="text-muted">{{ p.subtitle }}</p>
                    <div v-if="p.content" v-html="p.content"></div>

                    <a :href="p.linkUrl" class="btn py-2 mt-3" :style="`background:${p.backgroundColor}; color:${p.textColor};`">
                        {{ p.linkLabel }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cardMaxWidth: {default:'100%'},
        prices: Array,
    },
}
</script>

<style>
/* .card {
    position: relative;
    background: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, .1);
    overflow: hidden;
    padding: 20px;
    border: none
} */

.ribon {
    width: 30px;
    transform: rotate(90deg);
    transform-origin: 100% 0%
}

.vertical-align {
    vertical-align: text-top
}

.ribbon {
    width: 150px;
    height: 150px;
    position: absolute
}

.ribbon span {
    position: absolute;
    display: block;
    width: 225px;
    height: 30px;
    padding: 6px 0;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
    color: #fff;
    font-size: 11px;
    text-transform: uppercase;
    text-align: center
}

.ribbon-top-right {
    top: -8px;
    right: -35px
}

.ribbon-top-right span {
    left: -25px;
    top: 30px;
    transform: rotate(45deg)
}

.fs-10 {
    font-size: 12px
}

.bottom {
    margin: 0%;
    border-bottom: 1px dashed #812eca
}

.fas.fa-percentage {
    background-color: #812eca;
    color: white;
    font-size: 10px;
    padding: 4px;
    margin: 0 4px
}

@media (max-width:400px) {
    .ribon {
        width: 95px;
        transform: rotate(0);
        transform-origin: -100% 0
    }
}
</style>