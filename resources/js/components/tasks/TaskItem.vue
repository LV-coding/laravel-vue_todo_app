<template>
    <tr  :class="!this.$parent.isEdit(task.id) ? '' : 'd-none'">
        <th scope="row">{{ index +1 }}</th>
        <td>{{ task.title }}</td>
        <td >{{ task.priority }}</td>
        <td >{{ task.deadline }}</td>
        <td> 
            <button type="button" class="btn btn-info btn-sm  btn-right" @mouseover="showDescription" @mouseleave="hideDescription">Info</button>

            <template  v-if="task.is_done">
                <button type="button" class="btn btn-secondary btn-sm" disabled>{{ task.closing_date }}</button>
            </template>

            <template v-else>
                <button type="button" class="btn btn-success btn-sm btn-right" @click.prevent="markDone(task.id)">Done!</button>
                <button type="button" class="btn btn-warning btn-sm btn-right" 
                @click.prevent="this.$parent.changeEditTaskId(task.id, task.title, task.priority, task.deadline, task.description)">Edit</button> 
                <button type="button" class="btn btn-danger btn-sm" @click.prevent="deleteTask(task.id)">Delete</button>
            </template>
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
            },
            markDone(id) {
                axios.get('/sanctum/csrf-cookie').then(r => {
                    axios.post(`/api/tasks/${id}/done`).then(response => {
                        console.log(response)
                        this.$parent.getTasks()
                    })
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
.btn-right {
    margin-right: 2px;
}
</style>
