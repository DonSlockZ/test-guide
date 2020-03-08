<template>
    <div>
        <form @submit.prevent="findOrganizations()">
            <label for="organizationSearch">Поиск организации</label>
            <input type="search"
                   id="organizationSearch"
                   v-model="searchName"
            >
            <button>Поиск</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "OrganizationSearch",
        data() {
            return {
                searchName: ""
            };
        },
        methods: {
            findOrganizations() {
                console.log('findOrganizations');
                this.$router.push({ name: 'organizationsSearch', query: { searchName: this.searchName } }).catch(err => {
                    if (err.name !== "NavigationDuplicated") {
                        throw err;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>