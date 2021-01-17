
<template>
    <div class="myinfo">
        <section class="sidebar">
            <h4>メニュー</h4>
            <router-link to="/tasks" @click.native="taskChoised()"><i class="fas fa-th-list fontawasome-list"></i>タスク</router-link>
            <router-link to="/status" @click.native="statusChoised()"><i class="fas fa-user fontawasome-status"></i>ステータス</router-link>
            <router-link to="/items" @click.native="itemChoised()"><i class="fas fa-gift fontawasome-item"></i>アイテム</router-link>
            <!--<router-link to="/taskform">タスクを登録する</router-link>-->
            <span></span>
            <p>
                {{getUserInfo.name}}
            </p>
            <p><i class="fas fa-child fonticon_level"></i>LEVEL<br>
                {{getUserInfo.lv}}
            </p>
            <p><i class="far fa-heart fonticon_hp"></i>HP<br>
                {{getUserInfo.hp}}
            </p>
            <p><i class="fas fa-coins fonticon_money"></i>GOLD<br>
                {{getUserInfo.money}}
            </p>

            <span>{{description}}</span>
        </section>
        

        <RouterView /> 
        <Message />
    </div>
</template>

<script>
//import func from '../../../vue-temp/vue-editor-bridge';
    import Message from './Message.vue';//ok
    export default {
        data(){
            return {
                isActive:null,
                description:"タスク一覧画面を開きました。タスクの登録、左側のアイコンで実施しましょう。"
            }
        },
        components:{
            Message
        },
        computed: {
            getUserInfo() {
            return this.$store.getters.userinfo;
            }
        },
        mounted(){
            //console.log("myinfo.vueのmouted");
            //this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
        },
        methods:{
            taskChoised:function(){
                this.description = `タスクの追加や実施を行います。
                タスクを実行すると、能力値が難易度に沿って上がります！経験値とお金は初めて実施するときだけランダムに手に入ります。どんどん強くなりましょう。`;
                //console.log(this.description);
            },
            statusChoised:function(){
                this.description = `各種ステータス、
                レベルなどを確認できます。`;
            },
            itemChoised:function(){
                this.description = `取得済みアイテム一覧を確認できます。`;
            }
        }

    }
</script>

