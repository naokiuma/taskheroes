<template>
<div>
    <div v-show="loading">
      <Loader></Loader>
    </div>
    <transition>
      <section class="task-form__wrapper">
        <h3 class="task-form__title">New Task</h3>
        <form class="task-form">
          タスクタイトル<br>
          <input class="" name="title" type="text"><br>
          詳細<br>
          <input class="" name="body" type="text"><br>
          カテゴリー<br>
          <input class="" name="category" type="text"><br>
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
      loading:true
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