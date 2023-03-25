<template>
    <div class="btns">
        <router-link :to="{name: 'task.create'}">
            <button class="btn btn-primary">Create task</button>
        </router-link>
    </div>
    <h3 class="title">Active tasks</h3>

    <div class="alert alert-danger" role="alert" v-if="errorMsg">
            {{ errorMsg }}
    </div>

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
                <tr  :class="!isEdit(task.id) ? '' : 'd-none'">
                    <th scope="row">{{ index +1 }}</th>
                    <td>{{ task.title }}</td>
                    <td >{{ task.priority }}</td>
                    <td >{{ task.deadline }}</td>
                    <td >  
                        <button type="button" class="btn btn-danger btn-sm btn-right" @click.prevent="deleteTask(task.id)">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm" 
                        @click.prevent="changeEditTaskId(task.id, task.title, task.priority, task.deadline, task.description)">Edit</button> 
                    </td>
                </tr>
                <tr :class="isEdit(task.id) ? '' : 'd-none'">
                    <th scope="row">{{ index +1 }}</th>
                    <td><input type="text" class="form-control mb-1" v-model="taskData.title"></td>
                    <td><input type="number" class="form-control mb-1" min="1" max="3" step="1" v-model="taskData.priority"></td>
                    <td><input type="text" class="form-control mb-1" datetime-local v-model="taskData.deadline"></td>
                    <td >  
                        <button type="button" class="btn btn-success btn-sm" @click.prevent="updateTask(task.id)">Update</button> 
                    </td>
                </tr>
                <tr :class="isEdit(task.id) ? '' : 'd-none'">
                    <td scope="row"></td>
                    <td colspan="3"><textarea cols="30" rows="5"  class="form-control mb-1" v-model="taskData.description"></textarea></td>
                </tr>
            </template>
        </tbody>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                editTaskId: '',
                taskData: {
                    title: '',
                    priority: '',
                    deadline: '',
                    description: ''
                },
                errorMsg: ''
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
            },
            updateTask(id) {
                this.editTaskId = null
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.patch(`/api/tasks/${id}`, this.taskData).then(response => {
                        if(response) {
                            this.getTasks()
                            console.log(response)
                        } else {
                            this.errorMsg = 'Invalid value, updating did not occur'
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
</style>