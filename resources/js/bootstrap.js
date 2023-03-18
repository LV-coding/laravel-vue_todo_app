import 'bootstrap';
import router from './router'
import axios from 'axios';


window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true; // need for laravel sanctum

window.axios.interceptors.response.use({}, error =>{
    const errors = [401, 419]
    if(errors.includes(error.response.status)) {
        const token = localStorage.getItem('x_xsrf_token')
        if(token) {
            localStorage.removeItem('x_xsrf_token')
        }
        router.push({name: 'user.login'})
    }
})
