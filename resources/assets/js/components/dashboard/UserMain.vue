<template>
    <div>
        <h2 class="text-center section-title my-4">My activity on Travel Blog</h2>
        <div class="dashboard-activity d-flex flex-lg-row flex-column justify-content-around align-items-center">    
            <div class="dashboard-stat bg-dark text-white rounded p-2 m-3">
                <div v-if="!countPosts" class="h-100 d-flex flex-column justify-content-center align-items-center">
                    <img class="dashboard-stat-img mb-3" src="/storage/images/sad-face.png" alt="Sad smile">
                    <h3 class="m-0 text-center">You have no posts</h3>
                </div>
                <div v-if="countPosts">
                    <div class="my-3 h-25">
                        <h3 class="stat-title text-center m-0">Total:<br> &#10004; {{ countPosts }} posts</h3>    
                    </div>
                    <div class="d-flex justify-content-start align-items-start p-2">
                        <h5 class="title-lp m-0 pl-3">Last post:</h5>
                        <div class="d-flex flex-column w-100">
                            <p class="border-bottom m-0">Date: {{ formatDate(lastPost.created_at) }}</p>
                            <p class="border-bottom">Title: {{ lastPost.title }} </p>
                            <img v-if="lastPost.photo" class="stat-img align-self-center" :src="`${img_path}/${lastPost.photo}`" alt="Photo for post">
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-stat bg-dark text-white rounded p-2 m-4">
                <div v-if="!countComments" class="h-100 d-flex flex-column justify-content-center align-items-center">
                    <img class="dashboard-stat-img mb-3" src="/storage/images/sad-face.png" alt="Sad smile">
                    <h3 class="m-0 text-center">You have no comments</h3>
                </div>
                <div v-if="countComments">
                    <div class="my-3 h-25">
                        <h3 class="stat-title text-center m-0">Total:<br> &#10004; {{ countComments }} comments</h3>
                    </div>
                    <div class="d-flex justify-content-start align-items-start p-2">
                        <h5 class="title-lp m-0 pl-3">Last comment:</h5>
                        <div class="d-flex flex-column w-100">
                            <p class="border-bottom m-0">Date: {{ formatDate(lastComment.created_at) }} </p>
                            <p class="border-bottom m-0">To post id: {{ lastComment.post_id }}</p>
                            <p class="m-0"> Text: {{ lastComment.text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                countPosts: "",
                countComments: "",
                lastPost: [],
                lastComment: [],
                img_path: "/storage/posts"
            }
        },
        mounted(){
           this.getActivity();
        },
        methods: {
            getActivity: function(query) {
                axios.get('/api/users/activity/' + this.$userId).then(response => {
                this.countPosts = response.data.countPosts;
                this.countComments = response.data.countComments;
                this.lastPost = response.data.lastPost;
                this.lastComment = response.data.lastComment;
                if (this.lastComment) {
                    this.lastComment.text = this.characterLimit(this.lastComment.text, 150);
                };
                if (this.lastPost) {
                    this.lastPost.title = this.characterLimit(this.lastPost.title, 50);
                };
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
            characterLimit: function(str, maxlength) {
                return (str.length > maxlength) ? str.slice(0, maxlength - 1) + '…' : str;
            }
        }
    }
</script>