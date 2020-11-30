import Vue from 'vue';
import Vuex from 'vuex';

//import tasks from './modules/tasks.js';
//import parameters from './modules/parameter.js';


Vue.use(Vuex);

const store = new Vuex.Store({
    //複数のstoreに分割する場合はnamespacedが必要
    //https://kntmr.hatenablog.com/entry/2018/02/28/200112
    namespaced:true,
    state:{
        user:[],
        test:"テストですよ"
    },
    mutations:{
        setUser(state,user){
            this.state.user = user
        }
    },
    getters:{
        username:state => state.user ? state.user.name : ''

    },
    actions:{
            async register(context){
                console.log("storeのregisterが実施");
                const response = await axios.get('/user/logincheck')
                console.log(response.data);
                context.commit('setUser',response.data);
                //console.log(this.state.user);
        }
    }

});


export default store;