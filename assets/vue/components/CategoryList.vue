<template>
    <ul>
        <template v-for="category in categories">
            <category-list-item :id="category.id" :name="category.name" :categories="category.categories"/>
        </template>
    </ul>
</template>

<script>
    import CategoryListItem from "../components/CategoryListItem";

    export default {
        name: "CategoryList",
        components: {
            CategoryListItem
        },
        props: {
            categories: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>