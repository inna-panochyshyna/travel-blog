<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <h2 class="text-center section-title my-4">Create new post</h2>
        <router-link :to="{ name: 'userPosts' }">
    	   <b-button variant="dark" class="mb-3">Back to my posts</b-button>
        </router-link>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group label="Title" label-for="input-title">
                <b-form-input id="input-title" v-model="title" placeholder="Enter the title of your new post" required></b-form-input>
            </b-form-group>
            <b-form-group label="Category" label-for="select-category">
                <b-form-select id="select-category" v-model="category" :options="categories" required></b-form-select>
            </b-form-group>
            <b-form-group label="Image" label-for="form-file">
                <b-form-file
                :state="Boolean(attachment)"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
                accept="image/*"
                @change="onAttachmentChange"
                ></b-form-file>
            </b-form-group>
            <div id="editor">
                <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" height="50vh"></ckeditor>
            </div>
            <div class="my-3 text-center">
                <b-button type="submit" variant="dark">Save</b-button>
                <b-button type="reset" variant="secondary">Reset</b-button>    
            </div>
        </b-form>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: 'editor',
        data() {
            return {
                items: [
                    {
                        text: 'Dashboard',
                        to: { name: 'main' }
                    },
                    {
                        text: 'Posts',
                        to: { name: 'userPosts' }
                    },
                    {
                        text: 'Create',
                        active: true
                    }
                ],
                editor: ClassicEditor,
                editorData: "",
                editorConfig: {
                    toolbar: ['bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList', '|', 'blockQuote']
                },
                categories: [{text: "Please select the category", value: null}],
                category: null,
                title: "",
                attachment: null,
                show: true
            };
        },
        mounted() {
            this.getCategories();
        },
        methods: {
            getCategories: function(query) {
                axios.get('/api/categories').then(response => {
                for (let i = 0; i < response.data.categories.length; i++) {
                    this.categories.push({text: response.data.categories[i].name, value: response.data.categories[i].id});
                }
                }).catch( error => {
                console.log(error)
                });
            },
            savePost() {
                const config = { 'content-type': 'multipart/form-data' };
                const formData = new FormData();
                formData.append('attachment', this.attachment);
                formData.append('title', this.title);
                formData.append('text', this.editorData);
                formData.append('user_id', this.$userId);
                formData.append('category_id', this.category);
                axios.post('/api/posts', formData, config).then(response => {
                    if(response.status==200) {
                        alert("New post has been successfully saved!");
                        this.$router.push({name: `adminPosts`});
                    }
                })
                    .catch(error => {
                    console.log(error)
                    });
            },
            onAttachmentChange (e) {
                this.attachment = e.target.files[0];
            },
            onSubmit(evt) {
                evt.preventDefault();
                this.savePost();
            },
            onReset(evt) {
                evt.preventDefault();
                this.title = '';
                this.category = null;
                this.attachment = null;
                this.editorData = '';
                this.show = false;
                this.$nextTick(() => {
                this.show = true
                });
            }
        }
    }
</script>


<style scoped>
.breadcrumb-items {
    background-color: transparent!important;
}        
</style>

<style>
.ck > .ck-editor__main > .ck-content {
    min-height: 25vh;
}
</style>