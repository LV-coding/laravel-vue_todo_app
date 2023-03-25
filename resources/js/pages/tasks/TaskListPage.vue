<template>
    <UserLink></UserLink>
    <TaskList></TaskList>
</template>

<script>
import TaskList from '../../components/tasks/TaskList.vue'
import UserLink from '../../components/UserLink.vue'

    export default {
        data() {
            return {
            }
        },
        components: {
            TaskList, UserLink
        },
    }
</script>

<style lang="scss" scoped>

</style>