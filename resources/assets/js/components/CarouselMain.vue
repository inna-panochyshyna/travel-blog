<template>
    <div class="section-slider">
        <b-carousel
        id="carousel-fade"
        style="text-shadow: 0px 0px 2px #000"
        fade
        indicators
        >
            <b-carousel-slide
                class="main-slider"
                v-for="item in carousel" v-bind:data="item" v-bind:key="item.title" 
                :caption="`${item.title}`" 
                :img-src="`${img_path}/${item.photo}`"
            ></b-carousel-slide>
        </b-carousel>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                carousel: [],
                img_path: "/storage/carousel"
            }
        },
        mounted(){
            axios.get('/api/carousel').then(response => {
                this.carousel = response.data;
            });
        }
    }
</script>