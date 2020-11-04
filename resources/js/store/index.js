import Vue from 'vue';
import Vuex from 'vuex';

import parameters from './modules/parameter.js';
import task from './modules/task.js';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        parameters,task
    }

});