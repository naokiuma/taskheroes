<template>
<div>
  <button class="button" @click="showForm = ! showForm">
  <i class="icon ion-md-add"></i>
  Submit a photo
 </button>
  <div v-show="showForm" class="task-form">
    <h2 class="title">New Task</h2>
    <form class="form">
      <input class="form__item" name="title" type="text">
      <input class="form__item" name="body" type="text">
      <div class="form__button">
        <button type="submit" class="button button--inverse">submit</button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
export default{
    data(){
        return{
            showForm: false
        }
    }

}

</script>