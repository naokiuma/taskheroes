
<template>
    <section class="messages" v-show="this.$store.state.message.messageShow">
        {{ this.$store.state.message.content }}
    <div class="messages-space"></div>
    </section>
      
</template>


<script>

    import { mapState } from 'vuex'

    export default {
        /*
        data(){
            return{
                messageShow:true
            }
        },
        */
        mounted(){//apiから一覧を取得
            this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
            console.log(this.$store.state.message);
            console.log("messageのcomputeedでした");

        }
    }
</script>

