<template>
    <section class="section-tasks">
        <h2>タスク一覧</h2>
        <button @click="beforeTasks()">未実施のタスク</button>
        <button @click="fetchtasks()">すべてのタスク</button>

        
        <div class="tasks-wrapper">

            <div  class="each-task card" v-for="task in tasks" :key="task.id">
                <div class="card__side card__side--front" v-bind:class="{ rotate: task.done }">

                    <div class="each-task__title">{{task.title}}</div>
                    <div class="each-task__body">{{task.body}}</div>
                    
                    <div class="each-task__category">
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
                    <div class="each-task__state">
                        <!--実施変更時のみ対応-->
                        <!--
                        <button v-if="!task.done" class="main-button" @click ="clicked(task)">完了！</button>
                        -->
                        <!--両方に対応-->
                        <button class="main-button" @click ="clicked(task)">完了!</button>
                    </div>
                </div>


                <div class="card__side card__side--back" v-bind:class="{ rotate: !task.done }">
                    <button class="main-button" @click ="clicked(task)">取り消し</button>
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
                //コントローラー側で処理
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