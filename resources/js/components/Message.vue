
<template>
    <!--<section class="messages" v-show="this.$store.state.message.messageShow">-->
    <div class="messages-wrapper">
    <!--<div class="messages-toggle" v-on:click="toggleMsgwindow()">開閉</div>-->
    <section class="messages" v-show="this.$store.state.message.messageShow == true">
        <p class="anim-typewriter">{{ this.$store.state.message.content }}</p>
    <!--<div class="messages-space"></div>-->
    </section>

    </div>
</template>


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
            console.log(this.$store.state.message.content);
            console.log("messageのcomputeedでした");

        },

        methods:{
            toggleMsgwindow(){
                console.log( "動いている");
                this.$store.state.message.messageShow = !this.$store.state.message.messageShow;
                this.messageShow = !this.messageShow;

        }
        }
    }
</script>

