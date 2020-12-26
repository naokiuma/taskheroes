<template>
<div>
    <div v-show="loading">
      <Loader></Loader>
    </div>
      <section class="task-form__wrapper">
        <form class="task-form" @submit.prevent="submit">
          
          <transition name="fade">
          <input v-show="!inputBody" class="" maxlength="20" name="title" type="text" placeholder="タスク名" required>
          </transition>
          

          <transition name="fade">
          <input v-show="inputBody" class="" maxlength="50"  name="body" type="textarea" placeholder="メモ"><br>
          </transition>
          
          <div class="label-wrapper">
            <label><input type="radio" v-model="categories_id" value="1">力</label>
            <label><input type="radio" v-model="categories_id" value="2">魔力</label>
            <label><input type="radio" v-model="categories_id" value="3">知識</label>
          </div>
          <div class="form-button-area">
            <button v-show="!inputBody" class="main-button" v-on:click = change()>メモを追加</button>
            <button v-show="inputBody" class="main-button" v-on:click = change()>名前に戻る</button>

            <button type="button" class="main-button">登録</button>
          </div>
        </form>
      </section>
</div>
</template>

<script>
import Loader from './Loader.vue';

export default{
  name: 'Taskform', // ← これが記入されているか
  components:{
    Loader
    },
  data(){
    return{
      title:'',
      body:'',
      categories_id:'',
      loading:false,
      inputBody:false
    }
  },
  methods:{
    submit(){
      this.loading = true;
      const formdata = {
        'title':this.title,
        'body':this.body,
        'categories_id':this.categories_id
      };
      self = this;
      axios.post('/tasks/create',formdata)
      .then(function(responce){
        console.log("ok");
        console.log(responce);
        self.loading = false;
      })
      .catch(function(error){
        console.log("ダメ");
        console.log(error);
      })
    },
    change(){
      this.inputBody = !this.inputBody;
    }
  }

}

</script>

<style scoped>
.v-enter {
  opacity: 0;
}

/* 表示アニメーション後のスタイル */
.v-enter-to {
  opacity: 1;
}

/* 表示アニメーション動作中のスタイル */
.v-enter-active {
  transition: all 500ms;
}

/* 非表示アニメーション動作前のスタイル */
.v-leave {
  opacity: 1;
}

/* 非表示アニメーション動作後のスタイル */
.v-leave-to {
  opacity: 0;
}

/* 非表示アニメーション動作中のスタイル */
.v-leave-active {
  transition: all 500ms;
}



</style>