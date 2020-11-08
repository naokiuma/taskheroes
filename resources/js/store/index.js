import Vue from 'vue';
import Vuex from 'vuex';

import tasks from './modules/tasks.js';
//import parameters from './modules/parameter.js';


Vue.use(Vuex);

const store = new Vuex.Store({
    modules:{
        tasks
    }

});

export default store;