<template>
    <div>
        <div>Поиск</div>
        <div>
            <h3>Рубрики</h3>
            <category-list :categories="categories"/>
        </div>
        <div>
            <div>Карточка организации</div>
        </div>
    </div>
</template>

<script>
    import CategoryList from "../components/CategoryList";

    export default {
        name: "Guide",
        components: {
            CategoryList
        },
        data() {
            return {
                name: ""
            };
        },
        computed: {
            isLoading() {
                return this.$store.getters["category/isLoading"];
            },
            hasError() {
                return this.$store.getters["category/hasError"];
            },
            error() {
                return this.$store.getters["category/error"];
            },
            hasCategories() {
                return this.$store.getters["category/hasCategories"];
            },
            categories() {
                return this.$store.getters["category/categories"];
            }
        },
        created() {
            this.$store.dispatch("category/top");
        },
        methods: {
        }
    }
</script>

<style scoped>

</style>