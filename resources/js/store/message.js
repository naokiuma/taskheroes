const state = {
    content:'message.jsのcontentですよよ！。',
    messageShow:true
//    itemDetailShow:false,
//    itemInfomation:{}
    
}

const mutations = {
    setContent(state,{content}){
        state.content = content
    }
    /*
    setItemDetail(state,{itemInfomation}){
        state.itemInfomation = {};
        state.itemDetailShow != state.itemDetailShow;
        console.log(itemInfomation);
        
    }
    */
}

export default{
    namespaced:true,
    state,
    mutations
}   