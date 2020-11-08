<template>
    <section class="section-status">
        <h1>タスク一覧</h1>
        {{ tasks }}
    </section>
</template>


<script>
//やはり基礎がだいじ
//https://vuex.vuejs.org/ja/guide/state.html
import { mapState } from 'vuex'
    export default {
        computed:mapState({
            tasks:state => state.tasks//mapstateの書き方
            /*
            tasks(){
                return this.$store.state.tasks;//storeのデータ
                //console.log("テスト");

            }
            */

            
        })

    }
</script>