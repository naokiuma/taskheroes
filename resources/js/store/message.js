const state = {
    content:'message.jsのcontentです！。',
    messageShow:true

}

const mutations = {
    setContent(state,{content}){
        state.content = content
    }

}

export default{
    namespaced:true,
    state,
    mutations
}   