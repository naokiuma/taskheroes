<template>
    <section class="section-tasks">
        <h2>タスク一覧</h2>
        <button @click="beforeTasks()">未実施のタスク</button>
        <button @click="fetchtasks()">すべてのタスク</button>

        
        <div class="tasks-wrapper">
            <div  class="each-task" v-for="task in tasks" :key="task.id" v-bind:class="{done: task.done}">

                    <div class="each-task__title">{{task.title}}</div>
                    <div class="each-task__body">{{task.body}}</div>
                    
                    <div class="each-taskcategory">
                        <div v-if="task.categories_id == '1'">
                        力
                        </div>
                        <div v-else-if="task.categories_id == '2'">
                        B
                        </div>
                        <div v-else-if="task.categories_id == '3'">
                        C
                        </div>
                    </div>
                    
                    <div class="task-state">
                        <!--実施変更時のみ対応-->
                        <!--
                        <button v-if="!task.done" class="main-button" @click ="clicked(task)">完了！</button>
                        <p v-else>実施済み</p>
                        -->
                        <!--両方に対応-->
                        <button class="main-button" @click ="clicked(task)">Done!</button>

                    </div>
                    <div v-if="!task.done">
                        <!-- 削除ボタンのモック -->
                        <button class="main-button">削除</button>
                    </div>



            </div>
        </div>
        <div class="card">
            <div class="card__side card__side--front">
            表
            </div>
            <div class="card__side card__side--back card__side--back-1">
            裏
            </div>
        </div>
    </section>
</template>




<script>

    export default {
        //props:['id'],
        data(){
            return{
                //test:"test前",
                tasks:[]
            }
        },
        
        mounted(){//apiから一覧を取得
            console.log("mounted");
            //this.fetchtasks();
            this.fetchtasks();
        },
        methods:{
            fetchtasks(){//すべてのtasks
                axios
                .get('/api/tasklist')
                .then(response => (this.tasks = response.data))
            },
            beforeTasks(){//未実施のtasks
                let filtertasks = [];
                    for(var i in this.tasks){
                        let task = this.tasks[i];
                        if(task.done == 0){
                            filtertasks.push(task);
                        }
                    }
                this.tasks = filtertasks;
            },
            clicked(task){
                //this.test = "test後"
                let target = task.id;
                //console.log(target);
                let self = this;
                console.log("今trueなのでfalseに変えます。")
                console.log('/tasks/change/' + target);
                axios.post('/tasks/change/' + target)
                .then(function(responce){
                    console.log("変更に成功しました。");
                    self.fetchtasks();
                })
                
            }
        },
        watch:{
            tasks:{
                async handler (){
                    await this.mounted;
                },
                imeediate:true
            }
        }

 
    }
</script>