<template>
    <li>
        {{name}}
        <template v-if="categories && categories.length">
            <category-list :categories="categories"/>
        </template>
    </li>
</template>

<script>
    export default {
        name: "CategoryListItem",
        components: {
            // NOTE - https://vuejs.org/v2/guide/components-edge-cases.html#Circular-References-Between-Components
            CategoryList: () => import('../components/CategoryList')
        },
        props: {
            id: {
                type: Number,
                required: true
            },
            name: {
                type: String,
                required: true
            },
            categories: {
                type: Array,
                required: false
            }
        }
    }
</script>

<style scoped>

</style>