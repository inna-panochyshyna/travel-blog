<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <h2 class="text-center section-title my-4">Create new category</h2>
        <router-link :to="{ name: 'adminCategories' }">
    	   <b-button variant="dark" class="mb-3">Back to categories</b-button>
        </router-link>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group label="Name" label-for="input-name">
                <b-form-input id="input-name" v-model="name" placeholder="Enter the name of new category" required></b-form-input>
            </b-form-group>
            <b-form-group label="Image" label-for="form-file">
                <b-form-file
                :state="Boolean(file)"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
                accept="image/*"
                @change="onFileChange"
                ></b-form-file>
            </b-form-group>
            <div class="my-3 text-center">
                <b-button type="submit" variant="dark">Save</b-button>
                <b-button type="reset" variant="secondary">Reset</b-button>    
            </div>
        </b-form>
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
                        text: 'Caregories',
                        to: { name: 'adminCategories' }
                    },
                    {
                        text: 'Create',
                        active: true
                    }
                ],
                name: "",
                file: null,
                show: true
            };
        },
        methods: {
            saveCategory() {
                const config = { 'content-type': 'multipart/form-data' };
                const formData = new FormData();
                formData.append('file', this.file);
                formData.append('name', this.name);
                axios.post('/api/categories', formData, config).then(response => {
                    if(response.status==200) {
                        alert("New category has been successfully created!");
                        this.$router.push({name: `adminCategories`});
                    }
                })
                    .catch(error => {
                    console.log(error)
                    });
            },
            onFileChange (e) {
                this.file = e.target.files[0];
            },
            onSubmit(evt) {
                evt.preventDefault();
                this.saveCategory();
            },
            onReset(evt) {
                evt.preventDefault();
                this.name = '';
                this.file = null;
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