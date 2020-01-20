<template>
  <div class="section pb-4" id="post">
    <blockquote class="blockquote m-0">
      <p>"Life Is Either A Daring Adventure Or Nothing At All"</p>
      <footer class="blockquote-footer">Helen Keller</footer>
    </blockquote>
    <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
    <div class="container">
      <div class="post">
        <div class="post-header">
          <h1 class="section-title">{{ post.title }}</h1>
          <div class="post-meta">
            <span class="time"> {{ formatDate(post.created_at) }} </span>
            <span class="author"> {{ author }} </span>
            <span class="category"> {{ category }} </span>
          </div>
        </div>
        <div class="post-image">
          <img v-if="post.photo" :src="`${imgPost_path}/${post.photo}`" alt="Image">
        </div>
        <div class="post-content" v-html="post.text"></div>
      </div>
      <router-link :to="{ name: 'posts' }">
        <b-button variant="dark" class="mb-3 mt-5">Back to posts</b-button>
      </router-link>
      <div class="border-top my-4 py-4">
        <h3 class="my-4"> {{ getNumberComments() }} Comments</h3>
        <div v-for="comment in comments" v-bind:data="comment" v-bind:key="comment.id" class="d-flex mb-3">
          <div class="mr-3">
            <img class="author-avatar rounded-circle" :src="`${imgUser_path}/${comment.user.avatar}`" :alt="comment.user.name">
          </div>
          <div class="border-left px-3">
            <span> {{ formatDate(comment.created_at) }} </span>
            <h5>{{ comment.user.name }}</h5>
            <p>{{ comment.text }}</p>
          </div>
        </div>  
      </div>
      <div v-if="!currentUserId" class="border-top my-4 py-4">
        <p class="text-center">Please login to leave a comment</p>
      </div>
      <div v-if="currentUserId" class="border-top my-4 py-4">
        <h3 class="my-4 text-center">Leave a comment</h3>
        <b-form @submit="onSubmit" @reset="onReset" class="text-center">
          <b-form-textarea
            v-model="commentToSave"
            placeholder="Your comment..."
            class="w-75 my-2 mx-auto"
            rows="10"
            required>
          ></b-form-textarea>
          <b-button type="submit" variant="dark">Save</b-button>
          <b-button type="reset" variant="secondary">Reset</b-button>
        </b-form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        items: [
                {
                  text: 'Home',
                  to: { name: 'home' }
                },
                {
                  text: 'Posts',
                  to: { name: 'posts' }
                },
                {
                  text: `${this.$route.params.id}`,
                  active: true
                }
              ],
        post: [],
        author: "",
        category: "",
        comments: [],
        currentUser: {},
        currentUserId: "",
        commentToSave: "",
        imgPost_path: "/storage/posts",
        imgUser_path: "/storage/avatars",
        show: true
      }
    },
    mounted() {
      this.getPost();
    },
    methods: {
      getPost: function(query) {
        axios.get('/api/posts/' + this.$route.params.id).then(response => {
        this.post = response.data.post;
        this.author = response.data.post.user.name;
        this.category = response.data.post.categories.name;
        this.comments = response.data.post.comments;
        this.currentUserId = response.data.userId;
        this.currentUser = response.data.user;
        }).catch( error => {
          console.log(error)
          });
      },
      getNumberComments: function() {
        return this.comments.length;
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
      saveComments() {
        let data = {};
        data.text = this.commentToSave;
        data.post_id = this.$route.params.id;
        data.user_id = this.currentUserId;
        axios.post('/api/comments', data).then(response => {
          console.log(response)})
          .catch(error => {
            console.log(error.response)
        });
        data.created_at = new Date();
        let user = {};
        user.avatar = this.currentUser.avatar;
        user.name = this.currentUser.name;
        data.user = Object.assign({}, user);
        this.comments.push(data);
        console.log(this.comments);
        this.commentToSave = "";
      },
      onSubmit(evt) {
        evt.preventDefault();
        this.saveComments();
      },
      onReset(evt) {
        evt.preventDefault();
        this.commentToSave = '';
        this.show = false;
        this.$nextTick(() => {
          this.show = true
        });
      }
    }
  }

</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 50px auto;
  padding: 0 15px;
}
.post-image {
  margin: 20px 0;
  padding: 30px 0;
  position: relative;
}
.post-image, .section-title {
    text-align: center;
}
.post-image img {
  width: 100%;
}
.post-meta {
  margin-bottom: 30px;
  text-align: center;
  text-transform: uppercase;
  font-size: .8em;
}
.time, .author {
  padding-right: 26px;
  position: relative;
}
.time:after,
.author:after {
  content: "";
  background: #DDDDDF;
  width: 8px;
  height: 8px;
  position: absolute;
  top: 50%;
  right: 7px;
  transform: translateY(-50%) rotate(45deg);
}
p {
  line-height: 1.5;
  margin-bottom: 1em;
  text-align: justify;
}
.author-avatar {
  height: 50px;
  width: 50px;
  object-fit: cover;
}

@media (min-width: 768px) {
  .container {
    padding: 0 45px;
  }
  .post-image:before {
    content: "";
    position: absolute;
    border: 6px solid #343a40;
    top: 10px;
    bottom: 10px;
    left: 35%;
    right: 35%;
  }
  .post-image img {
    width: 60%;
  }
}
</style>