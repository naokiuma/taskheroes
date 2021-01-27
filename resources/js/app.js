/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//ルーティング 定義をインポート
import router from './router';
// ルートコンポーネントをインポートする
import Myinfo from './components/MyinfoComponent.vue';
//import Message from './components/Message.vue';


//storeのインポート
import store from './store';
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('hero-component', require('./components/HeroComponent.vue').default);
Vue.component('myinfo-component', require('./components/MyinfoComponent.vue').default);
Vue.component('alltasks-component', require('./components/AllTasks.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


new Vue({
  el: '#alltasks',
  template:'<alltasks-component/>'
})

const createApp = async () => {
  await store.dispatch('register')

  new Vue({
    el: '#myinfo',
    mode: 'history',
    router,//ルーター使う定義
    store,
    component:{ Myinfo },
    template:'<myinfo-component/>'
  })
}

createApp();



