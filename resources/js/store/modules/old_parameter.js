const state = {
    parameters:[]
    /*
        test:"32",
    
        parameters:[
        {id:"hp", value:"50"},
        {id:"heart",value:"4"},
        {id:"power",value:"8"},
        {id:"speed",value:"3"},
        {id:"knowledge",value:"2"}
        
    ]
    */
}

const getters = {
    getParameters(state){
        return state.parameters;
    }
}

const mutations = {
    upExp(state){
        state.parameters.value++;
    }
};
const actions = {}

export default {
    namespaced:true,
    state,
    getters,
    mutations,
    actions
};

