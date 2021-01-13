require('./bootstrap');

vue = require('vue');
vue.component('Player', require('./components/Player.vue').default);
window.Vue = vue
