<template>
<div>
    <div v-show="loading">
      <Loader></Loader>
    </div>
    <transition>
      <section class="task-form__wrapper">
        <h3 class="task-form__title">New Task</h3>
        <form class="task-form" @submit.prevent="submit">
          タスクタイトル<br>
          <input class="" v-model="title" name="title" type="text"><br>
          詳細<br>
          <input class="" v-model="body" name="body" type="text"><br>
          カテゴリー<br>
          <input class="" v-model="categories_id" name="categories_id" type="tel"><br>
          <div class="form__button">
            <button type="submit" class="button button--inverse">タスクを登録</button>
          </div>
        </form>
      </section>
    </transition>
</div>
</template>

<script>
import Loader from './Loader.vue';

export default{
  components:{
    Loader
  },
  data(){
    return{
      title:'',
      body:'',
      categories_id:'',
      loading:false
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