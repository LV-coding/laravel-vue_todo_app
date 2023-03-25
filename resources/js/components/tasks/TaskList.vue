<template>
    <table class="table" v-if="tasks.length > 0">
        <thead>
            <tr>
            <th scope="col">№</th>
            <th scope="col">Title</th>
            <th scope="col">Priority</th>
            <th scope="col">Deadline</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <template  v-for="task, index in tasks">
                <TaskItem :task="task" :index="index"></TaskItem>
                <TaskEdit :task="task" :index="index"></TaskEdit>
            </template>
        </tbody>
    </table>
</template>

<script>
import TaskItem from '../../components/tasks/TaskItem.vue'
import TaskEdit from '../../components/tasks/TaskEdit.vue'

    export default {
        name: 'TaskList',
        data() {
            return {
                tasks: [],
                editTaskId: '',
                errorMsg: '',
                taskData: {
                    title: '',
                    priority: '',
                    deadline: '',
                    description: ''
                }
            }
        },
        components: {
            TaskItem, TaskEdit
        },
        methods: {
            getTasks() {
                this.errorMsg = ''
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.get('/api/tasks').then(response => {
                        if(response.data.data.length != 0) {
                            this.tasks = response.data.data
                        }
                    })
                })
            },
            changeEditTaskId(id, title, priority, deadline, description) {
                this.editTaskId = id
                this.taskData = {
                    title: title,
                    priority: priority,
                    deadline: deadline,
                    description: description
                }
            },
            isEdit(id) {
                return this.editTaskId === id
            }
        },
        mounted() {
            this.getTasks()
        }
    }
</script>

<style lang="scss" scoped>
.title {
    text-align: center;
}
.btn-right {
    margin-right: 2px;
}
.table {
    table-layout: fixed;
    width: 100%;
}
</style>