<template>
    <div>
        <div><a href="#" @click.prevent="$router.back()">Назад</a></div>
        <div v-if="isLoading">
            <p>Загрузка...</p>
        </div>
        <div v-else>
            <h3>{{organization.name}}</h3>
            <organization :name="organization.name" :address="organization.address" :phone="organization.phone" :description="organization.description"/>
        </div>
    </div>
</template>

<script>
    import Organization from "../components/Organization";

    export default {
        name: "OrganizationDetails",
        props: {
            id: {
                type: Number,
                required: true
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
            organization() {
                return this.$store.getters["organization/organizations"].filter(organization => organization.id === this.id)[0];
            }
        },
        created() {
            this.$store.dispatch("organization/getAll");
        },
        methods: {
        }
    };
</script>

<style scoped>

</style>