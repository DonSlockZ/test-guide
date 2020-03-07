<template>
    <div>
        <div><a @click="$router.go(-1)">Назад</a></div>
        <div class="row col">
            <h1>Organizations</h1>
        </div>

        <div
                v-if="isLoading"
                class="row col"
        >
            <p>Loading...</p>
        </div>

        <div
                v-else-if="hasError"
                class="row col"
        >
            <div
                    class="alert alert-danger"
                    role="alert"
            >
                {{ error }}
            </div>
        </div>

        <div
                v-else-if="!hasOrganizations"
                class="row col"
        >
            No organizations!
        </div>

        <div
                v-for="organization in organizations"
                v-else
                :key="organization.id"
                class="row col"
        >
            <organization :name="organization.name" />
        </div>
    </div>
</template>

<script>
    import Organization from "../components/Organization";

    export default {
        name: "Organizations",
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
            }
        },
        created() {
            this.$store.dispatch("organization/findAll");
        },
        methods: {
        }
    };
</script>

<style scoped>

</style>