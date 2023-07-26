
import { createApp } from 'vue'
import App from './App.vue'

import Echo from "laravel-echo"
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.VUE_APP_WEBSOCKETS_KEY,
    wsHost:process.env.VUE_APP_WEBSOCKETS_SERVER,
    wsPort: 6001,
    cluster: "mt1",
    forceTLS: false,
    disableStats: true,
    authEndpoint :'http://127.0.0.1:8000/api/broadcasting/auth',
    auth:{
        headers: {
            Authorization: 'Bearer '+YOUR_TOKEN_FROM_LOGIN, 
        }
    },
 
});
createApp(App).mount('#app')