<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <div class="mx-5 my-3">
            <h2 class="text-center section-title my-4">{{ post.title }}</h2>
            <div class="text-right">
                <span> {{ formatDate(post.created_at) }} / </span>
                <span> {{ category }} </span>
            </div>
            <div class="text-center m-2">
                <img v-if="post.photo" :src="`${imgPost_path}/${post.photo}`" class="post-img" alt="Posts photo">
            </div>
            <div class="mt-3 text-justify" v-html="post.text"></div>
            <router-link :to="{ name: 'adminPosts' }">
                <b-button variant="dark" class="mb-3 mt-5">Back to all posts</b-button>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            items: [
                {
                  text: 'Dashboard',
                  to: { name: 'mainAdmin' }
                },
                {
                  text: 'Posts',
                  to: { name: 'adminPosts' }
                },
                {
                  text: `${this.$route.params.id}`,
                  active: true
                }
            ],
            post: [],
            category: "",
            imgPost_path: "/storage/posts",
            }
        },
        mounted() {
            this.getPost();
        },
        methods: {
            getPost: function(query) {
                axios.get('/api/posts/' + this.$route.params.id).then(response => {
                this.post = response.data.post;
                this.category = response.data.post.categories.name;
                }).catch( error => {
                    console.log(error)
                });
            },
            formatDate: function(date) {
                let data = new Date(date);
                let dayOfMonth = data.getDate();
                let month = data.getMonth() + 1;
                let year = data.getFullYear();
                month = month < 10 ? '0' + month : month;
                dayOfMonth = dayOfMonth < 10 ? '0' + dayOfMonth : dayOfMonth;
                return `${dayOfMonth}.${month}.${year}`;
            },
        }
    }
</script>

<style scoped>
.post-img {
    width: 400px;
    height: 300px;
    object-fit: cover;
}

.breadcrumb-items {
    background-color: transparent!important;
}
</style>