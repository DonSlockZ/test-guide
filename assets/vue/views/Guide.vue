<template>
    <div>
        <div>
            <organization-search/>
        </div>
        <div>
<!--            <h3>Рубрики</h3>-->
<!--            <category-list :categories="categories"/>-->
            <h3>Рубрики</h3>
            <div v-if="isLoading">
                <p>Загрузка...</p>
            </div>

            <div v-else-if="hasError">
                <p>Ошибка: {{error}}</p>
            </div>

            <div v-else-if="!hasCategories">
                <p>Нет данных</p>
            </div>

            <div v-else>
                <ul>
                    <template v-for="category in categories">
                        <li @click="selectTopCategory(category.id)">{{category.name}}</li>
                        <template v-if="category.id === selectedTopCategoryId">
                            <ul>
                                <li v-for="subCategory in category.categories">
                                    <router-link :to="{ name: 'category', params: { categoryId: subCategory.id }}">{{subCategory.name}}</router-link>
                                </li>
                            </ul>
                        </template>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import CategoryList from "../components/CategoryList";
    import OrganizationSearch from "../components/OrganizationSearch";

    export default {
        name: "Guide",
        components: {
            CategoryList,
            OrganizationSearch
        },
        data() {
            return {
                name: "",
                selectedTopCategoryId: null,
                searchName: ""
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
            selectTopCategory(categoryId) {
                this.selectedTopCategoryId = categoryId;
            },
        }
    }
</script>

<style scoped>
    li {
        cursor: pointer;
        color: rgb(0, 0, 0);
    }
    li:visited {
        color: rgb(85, 26, 139);
    }
</style>