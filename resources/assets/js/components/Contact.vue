<template>
    <div class="section pb-4" id="contact">
        <blockquote class="blockquote m-0">
            <p>"Travel Is The Only Thing You Buy That Makes You Richer"</p>
            <footer class="blockquote-footer">Anonymous</footer>
        </blockquote>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <h2 class="text-center section-title my-4">Contact</h2>
        <iframe class="contact-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2175.2720789611085!2d28.396813356808664!3d49.2272189692915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472d5c45ae0ac501%3A0x2b88e678e1e6dd4e!2sMykoly%20Vaschuka%20St%2C%2020%2C%20Vinnytsia%2C%20Vinnyts&#39;ka%20oblast%2C%2021000!5e0!3m2!1sen!2sua!4v1577284899860!5m2!1sen!2sua"></iframe>
        <div class="row p-3 m-0">
            <div class="col-12 col-md-6">
                <h3 class="text-center my-3">GET IN TOUCH</h3>
                <p class="text-center m-0">Interested in learning more about what Travel Blog has to offer?</p>
                <p class="text-center p-0">Have any question? Contact us!</p>
                <div class="d-flex">
                    <img class="img-contact mr-2" src="/storage/images/place.png" alt="Location"> 
                    <p class="p-contact m-0">Vashchuka str. 20, Vinnytsia, 21029, Ukraine</p> 
                </div>
                <div class="d-flex">
                    <img class="img-contact mr-2" src="/storage/images/mail.png" alt="Message">
                    <p class="p-contact m-0">admin@gmail.com</p>
                </div>
                <div class="d-flex">
                    <img class="img-contact mr-2" src="/storage/images/phone.png" alt="Phone">
                    <p class="p-contact m-0">+38(067)431-74-24</p>
                </div>
            </div>
            <div class="col-12 col-md-6"> 
                <h3 class="text-center my-3">CONTACT FORM</h3>
                <b-form @submit="onSubmit" @reset="onReset" v-if="show" class="text-center">
                    <b-form-input v-model="form.email" type="email" class="mb-2" placeholder="Enter email" required></b-form-input>
                    <b-form-input v-model="form.name" type="text" class="mb-2" placeholder="Enter name" required></b-form-input>
                    <b-form-textarea v-model="form.text" class="mb-2" rows="8" placeholder="Enter message"  required></b-form-textarea>
                    <b-button type="submit" variant="dark">Send</b-button>
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
                    text: 'Contact',
                    active: true
                    }
                ],
                form: {
                    email: '',
                    name: '',
                    text: '',
                },
                show: true
            }
        },
        methods: {
            sendMessage: function() {
                console.log(this.form);
                axios.post('/api/messages', this.form).then(response => {
                        if(response.status === 200) {
                        alert("Thanks for your question! We will answer you soon");
                        }
                    }).catch(error => {
                    alert("Something went wrong! Please try again later");
                    });
                this.form = {};
                
            },
            onSubmit(evt) {
                evt.preventDefault();
                this.sendMessage();
            },
            onReset(evt) {
                evt.preventDefault();
                this.form = {};
                this.show = false;
                this.$nextTick(() => {
                this.show = true
                });
            }
        }
    }
</script>