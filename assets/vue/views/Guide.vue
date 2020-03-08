<template>
    <div>
        <div>
            <form>
                <label for="organizationSearch">Поиск организации</label>
                <input type="search" name="organization" id="organizationSearch">
            </form>
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

    export default {
        name: "Guide",
        components: {
            CategoryList
        },
        data() {
            return {
                name: "",
                selectedTopCategoryId: null
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
            }
        }
    }
</script>

<style scoped>

</style>