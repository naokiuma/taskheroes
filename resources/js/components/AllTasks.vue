<template>
    <div class="alltasks-page-wrap">
        <div class="alltasks-wrap">
            <h2 class="all-tasks">みんなのタスク</h2>

            <div class="tabs">
                <input id="all" type="radio" name="tab_item" checked>
                <label class="tab_item" for="all">総合</label>

                <input id="programming" type="radio" name="tab_item">
                <label class="tab_item" for="programming">プログラミング</label>

                <input id="design" type="radio" name="tab_item">
                <label class="tab_item" for="design">デザイン</label>
                
                <div class="tab_content" id="all_content">
                    <div class="tab_content_description">
                    <p class="c-txtsp">総合の内容がここに入ります</p>
                    </div>
                </div>
                <div class="tab_content" id="programming_content">
                    <div class="tab_content_description">
                    <p class="c-txtsp">プログラミングの内容がここに入ります</p>
                    </div>
                </div>
                <div class="tab_content" id="design_content">
                    <div class="tab_content_description">
                    <p class="c-txtsp">デザインの内容がここに入ります</p>
                    </div>
                </div>
            </div>

            <div class="each-task card" v-for="task in tasks" :key="task.id">
                <div class="each-task__category">
                        <div class="each-task-Done-icon" v-if="task.categories_id == '1'">
                            <img src="/../img/ken.png" alt="">
                        </div>
                        <div class="each-task-Done-icon" v-else-if="task.categories_id == '2'">
                            <img src="/../img/mahou.png" alt="">
                        </div>
                        <div class="each-task-Done-icon" v-else-if="task.categories_id == '3'">
                            <img src="/../img/know.png" alt="">
                        </div>
                    </div>
                    <div class="each-task__title_outer">
                        <div class="each-task__title_inner">{{task.title}}</div> 
                    </div>
                    
                    <div class="each-task__difficult" v-html="forDifficult(task.difficult)"></div>
                    <span class="each-task__time">投稿日時：{{task.created_at}}</span>
                    
                    
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
                    //console.log(response)//すべてのtaskを取得する
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