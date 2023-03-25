<template>
    <div class="task-form">
        <input type="text" v-model="taskData.title"
        class="form-control mb-1" placeholder="Title">

        <input type="number" v-model="taskData.priority" @input="checkPriorityValue"
        class="form-control mb-1" placeholder="Priority (value 1-3)" min="1" max="3" step="1">

        <input type="datetime-local" v-model="taskData.deadline"
        class="form-control mb-1" placeholder="Deadline">

        <textarea cols="30" rows="10" v-model="taskData.description" 
        placeholder="Description (optional)" class="form-control mb-1">
        </textarea>

        <input type="submit" @click.prevent="storeTask" 
        :disabled="!isDisabled"
        value="Create" class="btn btn-primary mb-1">

        <div class="alert alert-danger" role="alert" v-if="errorMsg">
            {{ errorMsg }}
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
            storeTask() {
                axios.get('/sanctum/csrf-cookie').then(resp => {
                    axios.post('/api/tasks', this.taskData)
                    .then(response => {
                        if(response) {
                            this.$router.push({name: 'task.tasklist'})
                        } else {
                            this.errorMsg = 'Invalid value, please try again'
                        }
                        
                    }).catch(error => {
                        console.log(error.response)
                    })
                });
            }
        },
        computed: {
            isDisabled() {
                return this.taskData.title && this.taskData.priority && this.taskData.deadline
            },
            checkPriorityValue() {
                if (this.taskData.priority === '') {
                    this.errorMsg = ''
                } else if(this.taskData.priority < 1 || this.taskData.priority>3 ) {
                    this.errorMsg = 'Value must only 1, 2 or 3'
                } else {
                    this.errorMsg = ''
                }
            },
        }
    }
</script>

<style lang="scss" scoped>
.task-form {
    width: 60%;
    margin: auto;
}
</style>