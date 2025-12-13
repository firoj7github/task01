import { defineStore } from "pinia";
import axios from "@/axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: localStorage.getItem("token") || null,
        error: null,
        success: null,
    }),

    actions: {
        async register(name, email, password, password_confirmation) {
            try {
                const res = await axios.post("/api/register", {
                    name,
                    email,
                    password,
                    password_confirmation
                });
                console.log(res);

                if (!res.data?.data?.token) {
                    throw new Error("Authentication token not received");
                }

                this.token = res.data.data.token;
                this.user = res.data.data.user;
                localStorage.setItem("token", this.token);
                this.error = null;
                return res.data;
            } catch (err) {
                this.token = null;
                this.user = null;
                if (err.response && err.response.status === 422) {
                    this.error = err.response.data.errors || {};
                } else {
                    this.error = {
                        general: [
                            err.response?.data?.message || "Register failed",
                        ],
                    };
                }
            }
        },

        async login(email, password) {
            try {
                const res = await axios.post("/api/login", { email, password });
                console.log("LOGIN RESPONSE:", res);

                if (!res.data?.data?.token) {
                    throw new Error("Authentication token not received");
                }

                this.token = res.data.data.token;
                this.user = res.data.data.user;
                localStorage.setItem("token", this.token);
                this.error = null;
                return res.data;
            } catch (err) {
                this.token = null;
                this.user = null;
                if (err.response && err.response.status === 422) {
                    this.error = err.response.data.errors || {};
                } else {
                    this.error = {
                        general: [
                            err.response?.data?.message || "Login failed",
                        ],
                    };
                }
            }
        },

        async getUser() {
            try {
                const res = await axios.get("/api/user");
                this.user = res.data;
            } catch (err) {
                this.user = null;
                console.error("User fetch failed:", err);
            }
        },

        init() {
            if (this.token) {
                this.getUser();
            }
        },

        async logout() {
            try {
                const res = await axios.post("/api/logout");
                this.user = null;
                this.token = null;
                localStorage.removeItem("token");
                delete axios.defaults.headers.common["Authorization"];
               return res.data;
            } catch (err) {
                response.message =
                    err.response?.data?.message || response.message;
            } finally {
                this.user = null;
                this.token = null;
                localStorage.removeItem("token");
                delete axios.defaults.headers.common["Authorization"];
            }

            return response;
        },
    },
});
