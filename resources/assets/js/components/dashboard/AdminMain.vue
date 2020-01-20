<template>
    <div>
        <h2 class="text-center section-title my-4">Activity on Travel Blog</h2>
        <div class="dashboard-activity d-flex flex-column flex-sm-row justify-content-center align-items-center flex-wrap">    
            <div class="text-center bg-secondary text-white m-3 rounded-lg" v-for="(value, name) in activity" v-bind:data="activity" v-bind:key="name">
                <p v-if="!value" class="stat-title text-center p-4 m-0">No {{name}}</p> 
                <p v-if="value" class="stat-title text-center p-4 m-0">Total:<br> &#10004; {{value}} {{name}}</p> 
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                activity: {}
            }
        },
        mounted(){
           this.getActivity();
        },
        methods: {
            getActivity: function(query) {
                axios.get('/api/activity/').then(response => {
                this.activity = response.data;
                }).catch( error => {
                console.log(error)
                });
            }
        }
    }
</script>