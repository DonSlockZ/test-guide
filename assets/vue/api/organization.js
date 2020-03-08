import axios from "axios";

export default {
    getAll() {
        return axios.get("/api/organizations");
    },
    getByCategory(categoryId) {
        return axios.get("/api/categories/" + categoryId + "/organizations");
    },
    findByName(searchName) {
        return axios.get("/api/organizations", {
            params: {
                name: searchName
            }
        });
    }
};