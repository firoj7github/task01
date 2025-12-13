import axios from "axios";

const instance = axios.create({
    baseURL: "http://localhost:8000",
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
});

// Attach token automatically if exists
instance.interceptors.request.use((config) => {
    const token = localStorage.getItem("token");
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export default instance;
