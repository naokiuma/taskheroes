<template>
    <div class="alltasks-page-wrap">
        <div class="alltasks-area">
            <h2 class="all-tasks-lead">みんなのタスク</h2>
            <div class="all-tasks-commentary-area">
                <div class="img-wrap">
                    <img src="/../img/art.png" alt="">
                </div>
                <p class="text-wrap">みんなも頑張ってるな。。！おらもがんばろう！</p>
            </div>

            <div class="everybody-tasks-wrapper">
                <div class="everybody-task card" v-for="task in tasks" :key="task.id">
                    <div class="everybody-task__category">
                        <div class="everybody-task-Done-icon" v-if="task.categories_id == '1'">
                            <img src="/../img/ken.png" alt="">
                        </div>
                        <div class="everybody-task-Done-icon" v-else-if="task.categories_id == '2'">
                            <img src="/../img/mahou.png" alt="">
                        </div>
                        <div class="everybody-task-Done-icon" v-else-if="task.categories_id == '3'">
                            <img src="/../img/know.png" alt="">
                        </div>
                    </div>
                    
                    <div class="eaeverybody-task__title_outer">
                        <h3 class="everybody-task__title">{{task.title}}</h3> 
                    </div>
                    <div>
                        <span class="">投稿者：{{task.name}}</span>
                        <div class="everybody-task__difficult" v-html="forDifficult(task.difficult)"></div>
                        <span class="everybody-task__time">data：{{task.created_at}}</span>
                        
                    </div>
                     
                </div>
            </div>
            
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return{
            tasks:[],//実際に表示するtasks。これをソートする
            power:[],

        }
    },
    mounted(){//apiから一覧を取得
        let url = '/api/tasklist/';
                let self = this;
                axios.get(url).then(function(response){
                    console.log(response)//すべてのtaskを取得する
                    self.tasks = response.data
                 })
    },
    methods:{
            forDifficult(e){//難易度star表示
                let star = "難易度：";
                for(let i = 1; i <= e; i++){
                    star = star + "<i class='fas fa-running fontawasome-difficult'></i>";
                }
                return star;
            }
    }
    /*
    methods:{
        firstAllusersTasks(){//すべてのtasksを取得
                let url = '/api/tasklist/';
                let self = this;
                axios.get(url).then(function(response){
                    self.tasks = response.data
                 })
            }
    }
    */
    
}
</script>