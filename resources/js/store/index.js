import Vue from 'vue';
import Vuex from 'vuex';
import message from './message';
Vue.use(Vuex);

const store = new Vuex.Store({
    //複数のstoreに分割する場合はnamespacedが必要
    //https://kntmr.hatenablog.com/entry/2018/02/28/200112
    namespaced:true,
    state:{
        user:[]
        },
    mutations:{
        //ユーザー情報をset
        setUser(state,user){
            this.state.user = user
        }
    },
    getters:{
        username:state => state.user ? state.user.name : '',
        userinfo(state){
            return state.user;
        }

    },
    actions:{
            async register(context){
                console.log("storeのregisterが実施");
                const response = await axios.get('/user/logincheck');
                console.log("ユーザー情報の取得完了。" + response.data);
                context.commit('setUser',response.data);
                //console.log(this.state.user.power);
        }
    },
    modules:{
        message
    }
});


export default store;