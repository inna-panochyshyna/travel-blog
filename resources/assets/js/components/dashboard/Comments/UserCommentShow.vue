<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <div class="mx-5 my-3">
            <h3 class="text-center">Your comment from the {{ formatDate(comment.created_at) }} to the post:</h3>
            <div class="text-center my-3">
                <h4 class="text-center">{{ post.title }}</h4>
                <span> {{ formatDate(post.created_at) }} / </span>
                <span> {{ postAuthor }} /</span>
                <span> {{ postCategory }}</span>
            </div>
            <blockquote class="blockquote">
                <p v-html="comment.text"></p>
            </blockquote>
            <router-link :to="{ name: 'userComments' }">
                <b-button variant="dark" class="my-3">Back to my comments</b-button>
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
                  to: { name: 'main' }
                },
                {
                  text: 'Comments',
                  to: { name: 'userComments' }
                },
                {
                  text: `${this.$route.params.id}`,
                  active: true
                }
            ],
            comment: [],
            post: [],
            postAuthor: "",
            postCategory: "",

            }
        },
        mounted() {
            this.getComment();
        },
        methods: {
            getComment: function(query) {
                axios.get('/api/comments/' + this.$route.params.id).then(response => {
                this.comment = response.data.comment;
                this.post = response.data.comment.post;
                this.postAuthor = response.data.comment.post.user.name;
                this.postCategory = response.data.comment.post.categories.name;
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
            }
        }
    }
</script>

<style scoped>
.breadcrumb-items {
    background-color: transparent!important;
}
.blockquote {
    font-size: 14px;
    font-weight: 100;
    text-align: justify;
    background-image: none;
}
@media (max-width: 400px) {
    .blockquote {
        padding: 0;

    }
    .blockquote:before {
        display: none;
    }
}
</style>