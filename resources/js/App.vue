<template>
    <div  class="app">
        <Navbar></Navbar>
        <div class="main">
            <router-view></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'

    export default {
        name: 'App',

        components: {
            Navbar, Footer
        }
    }
</script>

<style lang="scss" scoped>
.app {
    min-height: 100vh;
}
.main {
    max-width: 800px;
    margin: auto;
    margin-top: 30px;
    padding: 10px;
}
</style> 
