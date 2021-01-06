
<template>
    <div class="myinfo">
        <section class="sidebar">
            <p>メニュー</p>
            <router-link to="/tasks" @click.native="taskChoised()"><i class="fas fa-th-list fontawasome-list"></i>タスク</router-link>
            <router-link to="/status" @click.native="statusChoised()"><i class="fas fa-user fontawasome-status"></i>ステータス</router-link>
            <router-link to="/items" @click.native="itemChoised()"><i class="fas fa-gift fontawasome-item"></i>アイテム</router-link>
            <!--<router-link to="/taskform">タスクを登録する</router-link>-->
            <!--sideIsClickedをふよ-->
            <span>{{description}}</span>
        </section>
        

        <RouterView /> 
        <!--<Message />-->
    </div>
</template>

<script>
//import func from '../../../vue-temp/vue-editor-bridge';
    import Message from './Message.vue';//ok
    export default {
        data(){
            return {
                isActive:null,
                description:""
            }
        },
        components:{
            Message
        },
        methods:{
            taskChoised:function(){
                this.description = `タスクの追加、
                確認や実施を行います。`;
            },
            statusChoised:function(){
                this.description = `各種ステータス、
                レベルなどを確認できます。`;
            },
            itemChoised:function(){
                this.description = `取得済みアイテム一覧を確認できます。
                未取得のアイテムにはヒントが見つかることもある。`;
            }


        },
        mounted(){
            console.log("myinfo.vueのmouted");
            //this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
  
        }
    }
</script>

