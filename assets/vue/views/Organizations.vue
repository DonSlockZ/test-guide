<template>
    <div>
        <div><a href="#" @click.prevent="$router.back()">Назад</a></div>

        <div v-if="categoryId">
            <h3 v-if="!isCategoryLoading">{{category.name}}</h3>
        </div>
        <div v-else>
            <organization-search/>
        </div>

        <div v-if="isLoading">
            <p>Загрузка...</p>
        </div>

        <div v-else-if="hasError">
            <div>
                {{ error }}
            </div>
        </div>

        <div v-else-if="!hasOrganizations">
            Нет данных
        </div>

        <div
                v-for="organization in organizations"
                v-else
                :key="organization.id"
        >
            <div>
                <router-link :to="{ name: 'organization', params: { organizationId: organization.id }}">{{organization.name}}</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import Organization from "../components/Organization";
    import OrganizationSearch from "../components/OrganizationSearch";

    export default {
        name: "Organizations",
        props: {
            categoryId: {
                type: Number,
                required: false
            },
            searchName: {
                type: String,
                required: false
            }
        },
        components: {
            Organization,
            OrganizationSearch
        },
        data() {
            return {
                searchNameString: ""
            };
        },
        computed: {
            isLoading() {
                return this.$store.getters["organization/isLoading"];
            },
            hasError() {
                return this.$store.getters["organization/hasError"];
            },
            error() {
                return this.$store.getters["organization/error"];
            },
            hasOrganizations() {
                return this.$store.getters["organization/hasOrganizations"];
            },
            organizations() {
                return this.$store.getters["organization/organizations"];
            },
            category() {
                return this.$store.getters["category/categories"].filter(category => category.id === this.categoryId)[0];
            },
            isCategoryLoading() {
                return this.$store.getters["category/isLoading"];
            },
        },
        created() {
            this.searchNameString = this.searchName;
            this.fetch();
        },
        // Is called when this component reused in the same route.
        // New props values can be fetched from 'to' argument
        beforeRouteUpdate (to, from, next) {
            this.searchNameString = to.query.searchName;
            this.fetch();
            next();
        },
        methods: {
            fetch() {
                if (this.categoryId) {
                    this.$store.dispatch("organization/getByCategory", this.categoryId);
                    this.$store.dispatch("category/getAll");
                } else if (this.searchNameString) {
                    this.$store.dispatch("organization/findByName", this.searchNameString);
                }
            }
        }
    };
</script>

<style scoped>

</style>