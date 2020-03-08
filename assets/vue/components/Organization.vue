<template>
    <div>
        <div>
            <strong>{{ name }}</strong>
        </div>
        <div>
            {{address}}
        </div>
        <div>
            {{phone}}
        </div>
        <div>
            {{description}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "Organization",
        props: {
            name: {
                type: String,
                required: true
            },
            address: {
                type: String,
                required: false
            },
            phone: {
                type: String,
                required: false
            },
            description: {
                type: String,
                required: false
            }
        }
    };
</script>

<style scoped>

</style>