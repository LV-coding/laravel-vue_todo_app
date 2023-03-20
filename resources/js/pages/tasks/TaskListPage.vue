<template>
    <h3 class="title">Active tasks</h3>
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
            <tr v-for="task, index in tasks">
                <th scope="row">{{ index +1 }}</th>
                <td>{{ task.title }}</td>
                <td >{{ task.priority }}</td>
                <td >{{ task.deadline }}</td>
                <td > 
                    <button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="deleteTask(task.id)">Delete</button> 
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                tasks: []
            }
        },
        methods: {
            getTasks() {
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.get('/api/tasks').then(response => {
                        if(response.data.data.length != 0) {
                            this.tasks = response.data.data
                        }
                    })
                })
            },
            deleteTask(id) {
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.delete(`/api/tasks/${id}`).then(response => {
                        this.getTasks()
                    })
                })
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
</style>