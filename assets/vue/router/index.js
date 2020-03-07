import Vue from "vue";
import VueRouter from "vue-router";
import Guide from "../views/Guide";
import Organizations from "../views/Organizations";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { path: "/", component: Guide },
        { path: "/organizations", component: Organizations },
        { path: "*", redirect: "/" }
        // { path: "/guide", component: Guide },
        // { path: "*", redirect: "/guide" }
    ]
});