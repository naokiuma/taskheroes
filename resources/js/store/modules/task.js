const { default: Axios } = require("axios");
const { update } = require("lodash");
const { Store } = require("vuex");

const state = {
    tasks:[]//ここのデータを、都度dbに打ち込めばいいのでは
};

const mutations = {
    setData(state,tasks){
        state.tasks = tasks
    },
    update(state,{task,newTask}){
        Object.assign(task,newTask);//Object.assingは第一引数にコピーする。
    },
    delete(state,index){
        state.tasks.splice(index,1);//何個目を削除するかはindexで指定、1は個数
    },
    add(state,task){
        state.tasks.push(task);
    }
};

const getters = {
    getTasks(state){
        return state.tasks;
    }
};

const actions = {
    async fetch ({ commit }){
        await axios.get('/api/tasks').then(res => {
            commit('setData',res.data);
        });
    },
    async delete ({state,commit},task){
        const index = state.tasks.indexOf(task);
        return await axios.delete('/api/tasks/' + task.id)
            .then(res =>{
                commit('delete',index);
                return true;
            }).catch(error => {
                return error;
            });
    },
    async store({state,commit},task){
        return await axios.post('/api/tasks/',task)
        .then(res => {
            commit('add',res.data);
            return true;
        }).catch(error => {
            return error;
        });
    },
    async update({state,commit},newTask){
        //stateからマッチしたtaskを取り出す
        const task = state.tasks.find((o) => {
            return o.id === newTask.id;
        });

        if(!task){//taskが無い場合
            return false;
        }

        return await axios.patch('/api/tasks/' + newTask.id, newTask)
            .then(res => {
                commit('update',{task,newTask});
                return true;
            }).catch(error => {
                return error;
            });
    }
};

export default{
    namespaced:true,
    state,
    mutations,
    getters,
    actions
};