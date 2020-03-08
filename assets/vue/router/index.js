import Vue from "vue";
import VueRouter from "vue-router";
import Guide from "../views/Guide";
import OrganizationDetails from "../views/OrganizationDetails";
import Organizations from "../views/Organizations";
import PageNotFound from '../views/errors/404.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { path: "/", component: Guide, name: "home" },
        { path: "/organizations", component: Organizations, props: true, name: "organizationsSearch" },
        // { path: "/organizations", component: Organizations, props: ({query}) => ({searchName: query.searchName}), name: "organizationsSearch" },
        { path: "/categories/:categoryId/organizations", component: Organizations, props: ({params}) => ({categoryId: Number.parseInt(params.categoryId, 10)}), name: "category" },
        { path: "/organizations/:organizationId", component: OrganizationDetails, props: ({params}) => ({id: Number.parseInt(params.organizationId, 10)}), name: "organization" },
        { path: "*", redirect: "/404"},
        { path: "/404", component: PageNotFound}
    ]
});