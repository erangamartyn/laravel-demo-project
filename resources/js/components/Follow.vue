<script>
import axios from 'axios';

export default {
    props: ['userId', 'follows'],

    data: function () {
        return {
            satus: this.follows,
        }
    },

    methods: {
        followUser() {
            axios.post('/follow/' + this.userId)
                .then(response => {
                    this.satus = !this.satus;
                    console.log(response.data);
                })
                .catch(errors => {
                    if (errors.response.satus == 401) {
                        window.location = '/login';
                    }
                });
        }
    },

    computed: {
        buttonText() {
            return (this.satus) ? 'Unfollow' : 'Follow';
        }
    }
}
</script>
<template>
    <button class="btn btn-primary btn-sm" @click="followUser" v-text="buttonText"></button>
</template>
