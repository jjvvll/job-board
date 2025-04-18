import axios from 'axios';
import Alpine from 'alpinejs'
import Echo from 'laravel-echo';
import { io } from 'socket.io-client';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Alpine = Alpine;

Alpine.start();

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

window.Echo = new Echo({
    broadcaster: 'reverb',
    host: 'http://localhost:6001', // or whatever port you're using
});
