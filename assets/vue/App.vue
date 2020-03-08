<template>
    <div class="container">
        <h1 class="main-title">
            <router-link :to="{ name: 'home'}">Справочник</router-link>
        </h1>
        <router-view />
    </div>
</template>

<script>
    export default {
        name: "App"
    };
</script>

<style scoped>
    .main-title a{
        color: rgb(0, 0, 0);
        text-decoration: none;
    }
    .main-title a:visited{
        color: rgb(0, 0, 0);
    }
</style>