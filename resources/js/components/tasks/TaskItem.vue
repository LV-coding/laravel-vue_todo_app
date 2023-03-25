<template>
    <tr  :class="!this.$parent.isEdit(task.id) ? '' : 'd-none'">
        <th scope="row">{{ index +1 }}</th>
        <td>{{ task.title }}</td>
        <td >{{ task.priority }}</td>
        <td >{{ task.deadline }}</td>
        <td >  
            <button type="button" class="btn btn-danger btn-sm btn-right" @click.prevent="deleteTask(task.id)">Delete</button>
            <button type="button" class="btn btn-secondary btn-sm btn-right" 
            @click.prevent="this.$parent.changeEditTaskId(task.id, task.title, task.priority, task.deadline, task.description)">Edit</button> 
            <button type="button" class="btn btn-info btn-sm" @mouseover="showDescription" @mouseleave="hideDescription">Info</button>
        </td>
    </tr>
    <tr v-if="descriptionVisibility">
        <td  colspan="5">Description: {{ task.description }}</td>
    </tr>
</template>

<script>
    export default {
        name: 'TaskItem',
        data() {
            return {
                descriptionVisibility: false
            }
        },
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
            showDescription() {
                this.descriptionVisibility = true
            },
            hideDescription() {
                this.descriptionVisibility = false
            }
        }
    }
</script>

<style lang="scss" scoped>
.btn-right {
    margin-right: 2px;
}
</style>
