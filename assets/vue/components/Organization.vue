<template>
    <div>
        <div>
            {{ name }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "Post",
        props: {
            name: {
                type: String,
                required: true
            }
        }
    };
</script>

<style scoped>

</style>