<template>
    <div class="w-25">
        <input type="email" v-model="userData.email"
        class="form-control mb-1" placeholder="Email">

        <input type="password" v-model="userData.password"
        class="form-control mb-1" placeholder="Password">

        <input type="submit" @click.prevent="loginUser" 
        :disabled="!isDisabled"
        value="Log In" class="btn btn-primary">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userData: {
                    email: '',
                    password: '',
                },
            }
        },
        methods: {
            loginUser() {
                axios.get('/sanctum/csrf-cookie').then(resp => {
                    axios.post('/login', this.userData)
                    .then(response => {
                        localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'task.tasklist'})
                    }).catch(error => {
                        console.log(error.response)
                    })
                });
            }
        },
        computed: {
            isDisabled() {
                return this.userData.email && this.userData.password
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>