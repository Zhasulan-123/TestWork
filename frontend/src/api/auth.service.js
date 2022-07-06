import httpClient from "@/api/http.service";
import router from "@/router";

const authService = {
    currentUser: null,
    isLoggedIn() {
        return !!localStorage.getItem('TOKEN')
    },
    getToken() {
        return localStorage.getItem('TOKEN')
    },
    async login(formData) {
        try {
            const { status, data } = await httpClient.post('login', formData);
            if (status === 200) {
                localStorage.setItem('TOKEN', data.token)
            }
            return {
                success: true
            }
        } catch (e) {
            return {
                errors: e.response.data.error
            }
        }
    },
    logout() {
        localStorage.removeItem('TOKEN');
        router.push('/');
    },
};

export default authService;