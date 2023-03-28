<template>
    <div>
        <template  v-for="filter_type in filter_types" :key="filter_type.value">
        <input type="radio" name="task_type" :value="filter_type.value" class="form-check-input" 
        v-model="checked_type" @change="selectItem(checked_type)"> {{ filter_type.title }}
        </template>
    </div>
</template>

<script>
    export default {
        name: 'TaskAction',
        data() {
            return{
                checked_type: '0',
                filter_types: [
                    {title: 'Active task', value: '0'},
                    {title: 'Сompleted tasks', value: '1'},
                    {title: 'All tasks', value: '2'},
            ]
            }
        },
        methods: {
            selectItem(checked_type) {
                this.$emit('check_type_value', checked_type)
            }
        },
        mounted() {
            this.selectItem(this.checked_type)
        }
    }
</script>

<style lang="scss" scoped>

</style>