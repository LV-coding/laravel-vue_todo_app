<template>
    <div  class="app">
        <Navbar></Navbar>
            <router-view></router-view>
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
</style> 
