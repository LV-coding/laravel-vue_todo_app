<template>
    <div class="btns">
        <router-link :to="{name: 'task.create'}">
            <button class="btn btn-primary">Create task</button>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: 'UserLink',
    }
</script>

<style lang="scss" scoped>

</style>