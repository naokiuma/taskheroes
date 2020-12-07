<template>
    <section class="section-tasks">
        <h2>タスク一覧</h2>
        <button @click="beforeTasks()">未実施のタスク</button>
        <button @click="fetchtasks()">すべてのタスク</button>

        
        <div class="tasks-wrapper">

            <div  class="each-task card" v-for="task in tasks" :key="task.id">
                <!--表-->
                <div class="card__side card__side--front" v-bind:class="{ rotate: task.done }">

                    <div class="each-task__title">{{task.title}}</div>
                    <div class="each-task__body">{{task.body}}</div>
                    
                    
                    <div class="each-task__category">
                        <div v-if="task.categories_id == '1'">
                        力
                        </div>
                        <div v-else-if="task.categories_id == '2'">
                        魔力
                        </div>
                        <div v-else-if="task.categories_id == '3'">
                        知力
                        </div>
                    </div>
                    <div class="each-task__state">
                        <button class="main-button" @click ="clicked(task)">完了!</button>
                    </div>
                </div>

                <!--裏-->
                <div class="card__side card__side--back" v-bind:class="{ rotate: !task.done }">
                        
                        <div class="each-task__title">{{task.title}}</div>
                        <div class="each-task__body">{{task.body}}</div>
                        
                        <p class="donetext">実施済み</p>
                        
                        <div class="each-task__category" v-bind:class="{ categoryDone: task.done }" >
                            <div v-if="task.categories_id == '1'">
                            力<i class="fas fa-arrow-up arrowopacity" v-bind:class="{ upmovearrow : task.done }"></i>
                            </div>
                            <div v-else-if="task.categories_id == '2'">
                            魔力<i class="fas fa-arrow-up arrowopacity" v-bind:class="{ upmovearrow : task.done }"></i>
                            </div>
                            <div v-else-if="task.categories_id == '3'">
                            知力<i class="fas fa-arrow-up arrowopacity" v-bind:class="{ upmovearrow : task.done }"></i>
                            </div>
                        </div>

                        <div class="each-task__state">
                            <button class="main-button" @click ="clicked(task)">戻す</button>
                        </div>
                </div>
            </div>
        </div>
        
    </section>
</template>




<script>
    export default {
        data(){
            return{
                tasks:[]
            }
        },
        mounted(){//apiから一覧を取得
            this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す

            console.log("mounted");
            this.fetchtasks();
        },
        methods:{
            fetchtasks(){//すべてのtasksを取得
            //console.log(this.$store.state.user);
            let url = '/api/tasklist/';
            if(this.$store.state.user.id){
                url = url + this.$store.state.user.id;
            }
            //console.log(url);//ユーザー情報ある場合は数字が末尾に入る
                axios
                .get(url)
                .then(response => (this.tasks = response.data))
            },
            beforeTasks(){//未実施のtasksを取得
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
                let target = task.id;
                let self = this;
                console.log('/tasks/change/' + target);
                axios.post('/tasks/change/' + target)
                .then(function(responce){
                    //console.log("変更に成功しました。");
                    self.fetchtasks();
                    //console.log(task.done);
                    //console.log(task.title);
                    let tempmsg;
                    let tempcategory;
                    if(task.categories_id == "1"){
                        tempcategory = "力";
                    }else if(task.categories_id == "2"){
                        tempcategory = "魔力";
                    }else{
                        tempcategory = "知力";
                    }
                    if(task.done == 1){
                        tempmsg = task.title + ' をキャンセルしました。' + tempcategory + 'が下がります。';
                    }else{
                        tempmsg = task.title + ' を実施しました。' + tempcategory + 'が上がりました。';
                        //console.log(tempmsg);
                    }                    
                    self.$store.commit('message/setContent',{
                        content: tempmsg
                    })
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