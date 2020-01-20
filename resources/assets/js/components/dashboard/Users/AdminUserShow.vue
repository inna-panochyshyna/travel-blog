<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <div class="mx-5 my-3">
            <div class="card dashboard-card">
                <div class="my-3 mx-auto">
                    <img v-if="user.avatar" :src="`${imgAvatar_path}/${user.avatar}`" class="card-img-top user-img rounded" alt="Photo of user">
                </div>
                <div class="card-body user-data">
                    <h3 class="card-title text-center">{{ user.name }}</h3>
                    <p class="card-text text-center font-italic">On Travel Blog from: {{ formatDate(user.created_at) }}</p>
                    <div class="d-flex d-flex justify-content-center align-items-center font-italic mb-3">
                        <p v-if="user.posts" class="card-text text-center my-0 mx-3">
                            <img src="/storage/images/posts.png" class="dashboard-icon mr-2" alt="Icon for posts">
                            {{ user.posts.length }} posts
                        </p>
                        <p v-if="user.comments" class="card-text text-center my-0 mx-3">
                            <img src="/storage/images/comments.png" class="dashboard-icon mr-2" alt="Icon for comments">
                            {{ user.comments.length }} comments
                        </p>    
                    </div>
                    <p class="card-text text-center font-italic">Role: {{ user.role }}</p>

                </div>
                <b-button v-if="user.role==='admin'" variant="dark" class="mb-3 mt-5" @click="setUser">Set as user</b-button>
                <b-button v-if="user.role==='user'" variant="secondary" class="mb-3 mt-5" @click="setAdmin">Set as admin</b-button>
            </div>
            <router-link :to="{ name: 'adminUsers' }">
                <b-button variant="dark" class="mb-3 mt-5">Back to all users</b-button>
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
                  text: 'Users',
                  to: { name: 'adminUsers' }
                },
                {
                  text: `${this.$route.params.id}`,
                  active: true
                }
            ],
            imgAvatar_path: "/storage/avatars",
            user: [],
            }
        },
        mounted() {
            this.getUser();
        },
        methods: {
            getUser: function(query) {
                axios.get('/api/users/' + this.$route.params.id).then(response => {
                this.user = response.data.user;
                console.log(this.user);
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
            setAdmin: function() {
                let data = {};
                data.role = 'admin';
                axios.post('/api/users/role/' + this.user.id, data).then(response => {
                console.log(response)})
                .catch(error => {
                    console.log(error.response)
                });
                this.user.role = data.role;
            },
            setUser: function() {
                let data = {};
                data.role = 'user';
                axios.post('/api/users/role/' + this.user.id, data).then(response => {
                console.log(response)})
                .catch(error => {
                    console.log(error.response)
                });
                this.user.role = data.role;
            }
        }
    }
</script>

<style scoped>
.user-img {
    width: 250px;
    height: 300px;
    object-fit: cover;
}

.user-data {
    font-size: 16px;
}

.breadcrumb-items {
    background-color: transparent!important;
}
</style>