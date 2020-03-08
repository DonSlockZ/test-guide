import CategoryAPI from "../api/category";

const FETCHING_CATEGORIES = "FETCHING_CATEGORIES",
    FETCHING_CATEGORIES_SUCCESS = "FETCHING_CATEGORIES_SUCCESS",
    FETCHING_CATEGORIES_ERROR = "FETCHING_CATEGORIES_ERROR";

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        categories: [],
        selectedCategory: {}
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
        hasCategories(state) {
            return state.categories.length > 0;
        },
        categories(state) {
            return state.categories;
        },
    },
    mutations: {
        [FETCHING_CATEGORIES](state) {
            state.isLoading = true;
            state.error = null;
            state.categories = [];
        },
        [FETCHING_CATEGORIES_SUCCESS](state, categories) {
            state.isLoading = false;
            state.error = null;
            state.categories = categories;
        },
        [FETCHING_CATEGORIES_ERROR](state, error) {
            state.isLoading = false;
            state.error = error;
            state.categories = [];
        }
    },
    actions: {
        async top({ commit }) {
            commit(FETCHING_CATEGORIES);
            try {
                let response = await CategoryAPI.top();
                commit(FETCHING_CATEGORIES_SUCCESS, response.data.data);
                return response.data.data;
            } catch (error) {
                commit(FETCHING_CATEGORIES_ERROR, error);
                return null;
            }
        },
        async getAll({ commit }) {
            commit(FETCHING_CATEGORIES);
            try {
                let response = await CategoryAPI.getAll();
                commit(FETCHING_CATEGORIES_SUCCESS, response.data.data);
                return response.data.data;
            } catch (error) {
                commit(FETCHING_CATEGORIES_ERROR, error);
                return null;
            }
        }
    }
};