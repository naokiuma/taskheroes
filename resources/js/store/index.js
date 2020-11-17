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
        user:""
    },
    mutations:{
        setUser(state,user){
            this.state.user = user
        }
    },
    actions:{
            async register(context){

            console.log("storeのregisterが実施");
            const response = await axios.get('/user/logincheck')
            context.commit('setUser',response.data);
            console.log(this.state.user);

            //.then(function(response){
            //    console.log(response.data);
            //    }
            //}
        }
    }
            
            
        

        //.then(response => (this.state.user = response.data))
        /*
        mounted(){//apiから一覧を取得
            console.log("mounted");
            axios
            .get('/api/tasklist')
            .then(response => (this.tasks = response.data))
            //console.log(this.tasks);
        },
        */
    

});
console.log(store.state.user);


export default store;