
<template>
    <div class="myinfo">
        <section class="sidebar">
            <router-link to="/tasks" v-bind:class="{sideIsClicked: isActive}" >タスク</router-link>
            <router-link to="/status" v-bind:class="{sideIsClicked: isActive}">ステータス</router-link>
            <router-link to="/items" v-bind:class="{sideIsClicked: isActive}">アイテム</router-link>
            <!--<router-link to="/taskform">タスクを登録する</router-link>-->
        </section>
        

        <RouterView /> 
        <!--<Message />-->
    </div>
</template>

<script>
    import Message from './Message.vue';//ok
    export default {
        data(){
            return {
                isActive:null
            }
        },
        components:{
            Message
        },
        mounted(){
            console.log("myinfo.vueのmouted");
            //this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
  
        }
    }
</script>

