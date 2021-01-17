
<template>
    <!--<section class="messages" v-show="this.$store.state.message.messageShow">-->
    <transition name="fade">        
        <div class="messages-wrapper">
            <div class="messages-toggle" v-on:click="toggleMsgwindow()">⇅</div>
            <section class="messages" v-show="this.$store.state.message.messageShow == true">
                <p class="anim-typewriter">{{ this.$store.state.message.content }}</p>
            <!--<div class="messages-space"></div>-->
            </section>
        </div>
    </transition> 
</template>

<style>
.fade-enter-active{ animation:fade-in .5s; }
.fade-leave-active{ animation:fade-in .5s reverse;}
</style>


<script>

    import { mapState } from 'vuex'
    export default {
        
        data(){
            return{
                messageShow:true
            }
        },
        mounted(){//apiから一覧を取得
            //this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
            //console.log(this.$store.state.message.content);
            //console.log("messageのcomputeedでした");

        },

        methods:{
            toggleMsgwindow(){
                this.$store.state.message.messageShow = !this.$store.state.message.messageShow;
                this.messageShow = !this.messageShow;
        }
        }
    }
</script>

