<template>
    <div>
        <div><a href="#" @click.prevent="$router.back()">Назад</a></div>
        <div v-if="!isCategoryLoading">
            <h3>{{category.name}}</h3>
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
            Organization
        },
        data() {
            return {
                name: ""
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
            if (this.categoryId) {
                this.$store.dispatch("organization/getByCategory", this.categoryId);
            } else if (this.searchName) {
                this.$store.dispatch("organization/findByName", this.searchName);
            }
            this.$store.dispatch("category/getAll");
        },
        methods: {
        }
    };
</script>

<style scoped>

</style>