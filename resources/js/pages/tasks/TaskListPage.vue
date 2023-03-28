<template>
    <UserLink></UserLink>
    <TaskAction @check_type_value="selectTypeTasks"></TaskAction>
    <TaskList :checked_type="checked_type"></TaskList>
</template>

<script>
import TaskList from '../../components/tasks/TaskList.vue'
import TaskAction from '../../components/tasks/TaskAction.vue'
import UserLink from '../../components/UserLink.vue'

    export default {
        data() {
            return {
                checked_type: ''
            }
        },
        components: {
            TaskList, UserLink, TaskAction
        },
        methods: {
            selectTypeTasks(checked) {
                this.checked_type = checked
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>