const state = {
    tasks:[
        {id: 1, title: 'sample task 1', done: 0 },
        {id: 2, title: 'sample task 1', done: 1 },
    ],//ここのデータを、都度dbに打ち込めばいいのでは
    newTask:"",
    showTask:"all"
}

const mutations = {
    input:function(state,child){
        state.newTask = child;
    }
}

const getters = {}

const actions = {}


export default{
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}


