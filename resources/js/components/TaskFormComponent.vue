<template>
<section class="task-form__wrapper">
  <!--
    <div v-show="loading">
      <Loader></Loader>
    </div>
  -->
  <form class="task-form" @submit.prevent="submit">
    <h2>New Task</h2>
    <input class="task-form-title" maxlength="50" name="title" type="text" v-model="title" placeholder="Task Name" required><br>
    <span>例：筋トレ、勉強、ゲームetc</span><br>
    <input class="task-form-body" maxlength="50"  name="body" type="textarea" v-model="body" placeholder="Task Detail"><br>
    <span>例：腕立て50回、参考書1時間、スマブラ30分etc</span><br>
    <div class="label-wrapper">
      <label><input type="radio" v-model="categories_id" value="1" checked="checked"><img src="/../img/ken.png" alt="">力</label>
      <label><input type="radio" v-model="categories_id" value="2"><img src="/../img/mahou.png" alt="">魔力</label>
      <label><input type="radio" v-model="categories_id" value="3"><img src="/../img/know.png" alt="">知識</label>
    </div>
    <div class="difficult-wrapper">
      <span>難易度</span>
      <select name="difficult" size="1" v-model="difficult" required>
        <option value="1" >1</option>
        <option value="2" >2</option>
        <option value="3" >3</option>
      </select>
      <!--
      <i class='fas fa-star' v-bind:class="{ fontawasome_star: test == true }"></i>
      <i class='fas fa-star fontawasome-star'></i>
      <i class='fas fa-star fontawasome-star'></i>
      -->
    </div>
    <div v-if="errors.length">
      <ul v-for="error in errors" :key="error.index">
        <p class="task-form__error">{{ error }}</p>
      </ul>
    </div>
    <div class="form-button-area">
      <button type="button" class="newTask-submit_button" v-on:click="submit()" >Submit</button>
    </div>
  </form>
</section>
</template>

<script>
//import Loader from './Loader.vue';

export default{
  name: 'Taskform', // ← これが記入されているか
  /*components:{
    Loader
    },
  */
  data(){
    return{
      title:'',
      body:'',
      categories_id:"1",
      difficult:"1",
      test:true,
      errors:[],
      //loading:false,
    }
  },
  methods:{
    submit(){
      const formdata = {
        'title':this.title,
        'body':this.body,
        'categories_id':this.categories_id,
        'difficult':this.difficult
      };
      this.errors = [];
      if(!this.title){
        this.errors.push("タイトルは必要です。")
      }
      if(!this.categories_id){
        this.errors.push("カテゴリーIDを選択してください。")
      }
      if(!this.difficult){
        this.errors.push("カテゴリーIDを選択してください。")
      }
      if (!this.errors.length) {
        this.errors = [];
      }

      self = this;
      axios.post('/tasks/create',formdata)
      .then(function(responce){
        //console.log("ok");
        //console.log(responce);
        let tempmsg =  "新しいタスクを投稿しました。"
        self.$store.commit('message/setContent',{//メッセージを入れ
          content: tempmsg
          })
        self.$emit("formClose");
        setTimeout(self.$router.go({path: self.$router.currentRoute.path, force: true}), 3000);
        //self.loading = false;
      })
      .catch(function(error){
        console.log("ダメ");
        console.log(error);
        let tempmsg =  "投稿できませんでした。赤字のエラーを確認してください。"
        self.$store.commit('message/setContent',{//メッセージを入れ
          content: tempmsg
          })
        })
    },
    ChoiceDifficult(){//難易度選択
      let star = "";
      for(let i = 1; i <= e; i++){
        star = star + "<i class='fas fa-star fontawasome-star'></i>";
        }
        return star;
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
  transition: all 300ms;
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
  transition: all 300ms;
}



</style>