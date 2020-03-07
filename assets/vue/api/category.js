import axios from "axios";

export default {
    top() {
        return axios.get("/api/top-categories");
    }
};