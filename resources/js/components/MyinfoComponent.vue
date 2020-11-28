
<template>
    <div id="myinfo">
        <router-link to="/status">ステータス</router-link>
        <router-link to="/tasks">タスク一覧</router-link>
        <router-link to="/taskform">タスクを登録する</router-link>

        <RouterView /> 
    </div>
      
</template>


<script>

    export default {
        mounted(){
            this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
        }
 
    }
</script>

