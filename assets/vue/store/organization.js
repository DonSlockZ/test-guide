import OrganizationAPI from "../api/organization";

const FETCHING_ORGANIZATIONS = "FETCHING_ORGANIZATIONS",
    FETCHING_ORGANIZATIONS_SUCCESS = "FETCHING_ORGANIZATIONS_SUCCESS",
    FETCHING_ORGANIZATIONS_ERROR = "FETCHING_ORGANIZATIONS_ERROR";

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        organizations: []
    },
    getters: {
        isLoading(state) {
            return state.isLoading;
        },
        hasError(state) {
            return state.error !== null;
        },
        error(state) {
            return state.error;
        },
        hasOrganizations(state) {
            return state.organizations.length > 0;
        },
        organizations(state) {
            return state.organizations;
        }
    },
    mutations: {
        [FETCHING_ORGANIZATIONS](state) {
            state.isLoading = true;
            state.error = null;
            state.organizations = [];
        },
        [FETCHING_ORGANIZATIONS_SUCCESS](state, organizations) {
            state.isLoading = false;
            state.error = null;
            state.organizations = organizations;
        },
        [FETCHING_ORGANIZATIONS_ERROR](state, error) {
            state.isLoading = false;
            state.error = error;
            state.organizations = [];
        }
    },
    actions: {
        async findAll({ commit }) {
            commit(FETCHING_ORGANIZATIONS);
            try {
                let response = await OrganizationAPI.findAll();
                commit(FETCHING_ORGANIZATIONS_SUCCESS, response.data.data);
                return response.data.data;
            } catch (error) {
                commit(FETCHING_ORGANIZATIONS_ERROR, error);
                return null;
            }
        }
    }
};