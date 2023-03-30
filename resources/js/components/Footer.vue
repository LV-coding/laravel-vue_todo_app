<template>
    <div class="footer">
        <div>
            <span class="text">
                @{{ currentYear }} by Me :)
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentYear: new Date().getFullYear()
            }
        }
    }
</script>

<style lang="scss" scoped>
.footer {
    text-align: center;
    width: 100%;
    height: 30px;
    position: fixed;
    bottom: 0;
    background-color: rgb(189, 253, 204);
    display: flex;
    align-items: center;
    justify-content: center;
}
.text {
    text-align: center;
}
</style>