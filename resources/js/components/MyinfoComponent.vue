
<template>
    <div class="myinfo">
        <!--<div class="sidebar-toggle" v-on:click="toggleSidebar()">menu ⇄</div>-->
        <transition name="fade">
        <!--pcのみ-->
            <section class="sidebar">
                <p>MENU</p>
                <router-link to="/tasks" @click.native="taskChoised()"><i class="fas fa-th-list fontawasome-list"></i>タスク</router-link>
                <router-link to="/status" @click.native="statusChoised()"><i class="fas fa-user fontawasome-status"></i>ステータス</router-link>
                <router-link to="/items" @click.native="itemChoised()"><i class="fas fa-gift fontawasome-item"></i>アイテム</router-link>
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
        </transition>

        <!--spのみ-->
        <section class="sp-Info-menu" v-show="sidebarShow == true">  
            <div class="sp-menu-wrap">
                <router-link to="/tasks" @click.native="taskChoised()"><i class="fas fa-th-list fontawasome-list"></i></router-link>
                <router-link to="/status" @click.native="statusChoised()"><i class="fas fa-user fontawasome-status"></i></router-link>
                <router-link to="/items" @click.native="itemChoised()"><i class="fas fa-gift fontawasome-item is-margin-right"></i></router-link>
                <p>
                    Name : {{getUserInfo.name}}
                </p>
            </div>

            <div class="sp-menu-wrap">
                <p><i class="fas fa-child fonticon_level"></i>
                    LEVEL：{{getUserInfo.lv}}
                    </p>
                <p><i class="far fa-heart fonticon_hp"></i>
                    HP：{{getUserInfo.hp}}
                </p>
                <p><i class="fas fa-coins fonticon_money"></i>
                    GOLD：{{getUserInfo.money}}
                </p>
            </div>
        </section>
        <RouterView /> 
        <Message />
    </div>
</template>

<style>
.fade-enter-active{ animation:fadeLeft-in .5s; }
.fade-leave-active{ animation:fadeLeft-in .5s reverse;}
</style>

<script>
//import func from '../../../vue-temp/vue-editor-bridge';
    import Message from './Message.vue';//ok
    export default {
        data(){
            return {
                isActive:null,
                description:"タスク一覧画面を開きました。タスクの登録、左側のアイコンで実施しましょう。",
                sidebarShow:true,
                choised:"タスク"
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
        methods:{
            taskChoised:function(){
                this.description = `タスクの追加や実施を行います。
                タスクを実行すると、能力値が難易度に沿って上がります！経験値とお金は初めて実施するときだけランダムに手に入ります。どんどん強くなりましょう。`;
                //console.log(this.description);
                this.choised = "タスク";
            },
            statusChoised:function(){
                this.description = `各種ステータス、
                レベルなどを確認できます。`;
                this.choised = "ステータス";
            },
            itemChoised:function(){
                this.description = `取得済みアイテム一覧を確認できます。`;
                this.choised = "アイテム";
            },
            toggleSidebar:function(){
                this.sidebarShow = !this.sidebarShow;

            }
        }

    }
</script>

