require( './bootstrap' );

import Application from "./views/Application.vue";
import {createApp} from "vue";
import router from './router';

const app = createApp( Application );
app.use( router );
app.mount('#app');
