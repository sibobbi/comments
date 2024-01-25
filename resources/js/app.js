/*import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();*/

import { createApp } from 'vue/dist/vue.esm-bundler';
import Main from './components/Main.vue';
import axios from 'axios';


const app = createApp({
components: {
'hello-vue' : Main,
}
});

app.mount('#app');
