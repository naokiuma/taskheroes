const state = {
    userItems:[]
}

const mutations = {
    setItem(state,{userItems}){
        state.userItems = userItems
    }
}

export default{
    namespaced:true,
    state,
    mutations
}   