<template>
    <div  class="app">
        <Navbar></Navbar>
        <div class="main">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue'

    export default {
        name: 'App',

        components: {
            Navbar 
        }
    }
</script>

<style lang="scss" scoped>
.app {
    padding: 20px;
}
.main {
    max-width: 800px;
    margin: auto;
    margin-top: 30px;
}
</style> 
