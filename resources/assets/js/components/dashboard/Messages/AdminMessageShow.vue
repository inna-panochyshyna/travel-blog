<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <div class="mx-5 my-3">
            <h3 class="text-center">Message of {{ message.name }} from the {{ formatDate(message.created_at) }}</h3>
            <blockquote class="blockquote">
                <p v-html="message.text"></p>
            </blockquote>
            <div v-if="message.answer">
                <p>Admin answer: {{ message.answer }}</p>
            </div>
            <div v-if="!message.answer">
                <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                    <b-form-group label="Admin sent the answer:" label-for="input-name">
                        <b-form-input id="input-name" v-model="answer" placeholder="Input the answer" required></b-form-input>
                    </b-form-group>
                    <div class="my-3 text-center">
                        <b-button type="submit" variant="dark">Save</b-button>
                        <b-button type="reset" variant="secondary">Reset</b-button>    
                    </div>
                </b-form>
            </div>
            <router-link :to="{ name: 'adminMessages' }">
                <b-button variant="dark" class="my-3">Back to all messages</b-button>
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
                  text: 'Messages',
                  to: { name: 'adminMessages' }
                },
                {
                  text: `${this.$route.params.id}`,
                  active: true
                }
            ],
            message: [],
            answer: "",
            show: true
            }
        },
        mounted() {
            this.getMessage();
        },
        methods: {
            getMessage: function(query) {
                axios.get('/api/messages/' + this.$route.params.id).then(response => {
                this.message = response.data.message;
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
            saveAnswer() {
                let data = {};
                data.answer = this.answer;
                axios.post('/api/messages/'+ this.$route.params.id, data).then(response => {
                    if(response.status==201) {
                        alert("The answer has been successfully saved!");
                        this.$router.push({name: `adminMessages`});
                    }
                })
                    .catch(error => {
                    console.log(error.response)
                });
            },
            onSubmit(evt) {
                evt.preventDefault();
                this.saveAnswer();
            },
            onReset(evt) {
                evt.preventDefault();
                this.answer = '';
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