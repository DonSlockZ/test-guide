import Vue from "vue";
import Vuex from "vuex";
import OrganizationModule from "./organization";
import CategoryModule from "./category";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        organization: OrganizationModule,
        category: CategoryModule
    }
});