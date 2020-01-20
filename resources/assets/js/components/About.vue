<template>
    <div class="section pb-4" id="about">
        <blockquote class="blockquote m-0">
            <p>"The world is a book, and those who do not travel, read only a page"</p>
            <footer class="blockquote-footer">Augustine, St.</footer>
        </blockquote>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <h2 class="text-center section-title my-4">About us</h2>
        <b-card-group deck>
            <b-card 
                v-for="card in cards" v-bind:data="card" v-bind:key="card.title"
                :title="`${card.title}`" 
                :img-src="`${img_path}/${card.photo}`" 
                :img-alt="`${card.title}`" 
                img-top
            >
                <b-card-text>
                    {{ card.text }}
                </b-card-text>
            </b-card>
        </b-card-group>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cards: [],
                img_path: "/storage/images",
                items: [
                    {
                        text: 'Home',
                        to: { name: 'home' }
                    },
                    {
                        text: 'About',
                        active: true
                    }
                ]
            }
        },
        mounted(){
            axios.get('/api/cards').then(response => {
                this.cards = response.data;
            });

        }
    }
</script>

<style scoped>
    .card-deck {
        margin-right: 0;
        margin-left: 0;
    }
</style>