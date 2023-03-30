<template>
    <div class="navbar">
        <div class="navbar__item">
            ToDo
        </div>
        <div class="navbar__link-group">
            <router-link :to="{name: 'main'}" class="navbar__link">Main</router-link>
            <router-link :to="{name: 'about'}" class="navbar__link">About</router-link>

            <router-link v-if="token" :to="{name: 'task.tasklist'}" class="navbar__link">Tasks</router-link>

            <router-link v-if="!token" :to="{name: 'user.login'}" class="navbar__link">Login</router-link>
            <router-link v-if="!token" :to="{name: 'user.registration'}" class="navbar__link">Registration</router-link>
            <a v-if="token" href="" @click.prevent="logout" class="navbar__link">Logout</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Navbar',

        data() {
            return {
                token: null
            }
        },

        methods: {
            logout() {
                axios.post('/logout')
                .catch(error => {
                    console.log(error.response)
                })
                .then(response => {
                    localStorage.removeItem('x_xsrf_token')
                    this.token = null
                    this.$router.push({name: 'user.login'})
                })
            },
            getToken() {
                this.token = localStorage.getItem('x_xsrf_token')
            }

        },
        mounted() {
            this.getToken()
        },
        watch: {
            $route: 'getToken'
        }
    }
</script>

<style lang="scss" scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    &__link {
        margin-left: 15px;
    }
}
</style>
