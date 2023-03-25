<template>
    <tr  :class="!this.$parent.isEdit(task.id) ? '' : 'd-none'">
        <th scope="row">{{ index +1 }}</th>
        <td>{{ task.title }}</td>
        <td >{{ task.priority }}</td>
        <td >{{ task.deadline }}</td>
        <td >  
            <button type="button" class="btn btn-danger btn-sm btn-right" @click.prevent="deleteTask(task.id)">Delete</button>
            <button type="button" class="btn btn-secondary btn-sm" 
            @click.prevent="this.$parent.changeEditTaskId(task.id, task.title, task.priority, task.deadline, task.description)">Edit</button> 
        </td>
    </tr>
</template>

<script>
    export default {
        name: 'TaskItem',
        props: {
            task: {required: true},
            index: {required: true}
        },
        methods: {
            deleteTask(id) {
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.delete(`/api/tasks/${id}`).then(response => {
                        this.$parent.getTasks()
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
