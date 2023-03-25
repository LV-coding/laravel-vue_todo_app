<template>
    <tr  :class="this.$parent.isEdit(task.id) ? '' : 'd-none'"> 
        <th scope="row"></th>
        <td><input type="text" class="form-control mb-1" v-model="this.$parent.taskData.title"></td>
        <td><input type="number" class="form-control mb-1" min="1" max="3" step="1" v-model="this.$parent.taskData.priority"></td>
        <td><input type="datetime-local" class="form-control mb-1" v-model="this.$parent.taskData.deadline"></td>
        <td >  
            <button type="button" class="btn btn-success btn-sm" @click.prevent="this.updateTask(task.id)">Update</button> 
        </td>
    </tr>
    <tr :class="this.$parent.isEdit(task.id) ? '' : 'd-none'">
        <td scope="row"></td>
        <td colspan="3"><textarea cols="30" rows="5"  class="form-control mb-1" v-model="this.$parent.taskData.description"></textarea></td>
    </tr>
</template>

<script>
    export default {
        name: 'TaskEdit',
        props: {
            task: {required: true},
        },
        methods: {
            updateTask(id) {
                this.$parent.editTaskId = null
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.patch(`/api/tasks/${id}`, this.$parent.taskData).then(response => {
                        if(response) {
                            this.$parent.getTasks()
                            console.log(response)
                        } else {
                            this.$parent.errorMsg = 'Invalid value, updating did not occur'
                        }
                    })
                })
            },
        }
    }
</script>

<style lang="scss" scoped>

.btn-right {
    margin-right: 2px;
}
</style>