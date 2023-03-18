<template>
    <div class="w-25">
        <input type="text" v-model="userData.name"
        class="form-control mb-1" placeholder="Name">

        <input type="email" v-model="userData.email"
        class="form-control mb-1" placeholder="Email">

        <input type="password" v-model="userData.password"
        class="form-control mb-1" placeholder="Password">

        <input type="password"  v-model="userData.password_confirmation"
        class="form-control mb-1" placeholder="Confirm password">

        <input type="submit" @click.prevent="registerUser"
        :disabled="!isDisabled"
        value="Registration" class="btn btn-primary">

    </div>
</template>

<script>
    export default {
        data() {
            return {
                userData: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
            }
        },
        methods: {
            registerUser() {
                axios.get('/sanctum/csrf-cookie').then(resp => {
                    axios.post('/register', this.userData).then(response => {
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
                return this.userData.name && this.userData.email && this.userData.password && this.userData.password_confirmation
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
