
<template>
    <div id="myinfo">
        <router-link to="/status">ステータス</router-link>
        <router-link to="/tasks">タスク一覧</router-link>
        <!--<router-link to="/taskform">タスクを登録する</router-link>-->

        <RouterView /> 
        <Message />
    </div>
</template>

<script>
    import Message from './Message.vue';//ok
    export default {
        components:{
            Message
        },
        mounted(){
            console.log("myinfo.vueのmouted");
            //this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
  
        }
    }
</script>

