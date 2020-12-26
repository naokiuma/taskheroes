<template>
    <section class="section-tasks">
        <h2>タスク一覧</h2>
        <button @click="beforeTasks()">未完了</button>
        <button @click="afterTasks()">完了</button>
        <button @click="fetchtasks()">すべて</button>
        <button @click="addTask()">+</button>
        <p>タスク数：</p>
        

        <div class="tasks-wrapper">
            <transition name="fade">
                <div class="newTask" v-show="newTask"><Taskform /></div>
            </transition> 
            
            <transition name="bounce">
                <div v-show="up" class="taskupParameters">{{ upcategory }} がアップ！</div>
            </transition> 
            
            <div class="each-task card" v-for="task in tasks" :key="task.id">
                <!--表-->
                <div class="card__side card__side--front" v-bind:class="{ rotate: task.done }">
                    <div class="each-task__title">{{task.title}}</div>
                    <div class="each-task__body" v-bind:class="{'is-active':activeItem === task}" >{{task.body}}</div>
                    
                    <div class="each-task__category">
                        <div v-if="task.categories_id == '1'">
                        力<img src="/../img/ken.png" alt="">
                        </div>
                        <div v-else-if="task.categories_id == '2'">
                        魔力<img src="/../img/mahou.png" alt="">
                        </div>
                        <div v-else-if="task.categories_id == '3'">
                        知力<img src="/../img/know.png" alt="">
                        </div>
                    </div>
                    <div class="each-task__state">
                        <button class="main-button" @click ="clicked(task)">実行</button>
                        <button class="main-button" v-on:click="onActive(task)">メモをみる</button>
                        <button class="sub-button" @click ="deleate(task)">削除</button>

                    </div>
                    <div class="each-task__difficult" v-html="forDifficult(task.difficult)"></div>
                    <span class="each-task__time">投稿日時：{{task.created_at}}</span>
                </div>

                <!--裏-->
                <div class="card__side card__side--back" v-bind:class="{ rotate: !task.done }">
                        
                    <div class="each-task__title">{{task.title}}</div>
                    <div class="each-task__body" v-bind:class="{'is-active':activeItem === task}" >{{task.body}}</div>                    
                    <p class="donetext">実施済み</p>
                    
                    <!--<div class="each-task__category" v-bind:class="{ categoryDone: task.done }" >-->
                    <div class="each-task__category">
                        <div v-if="task.categories_id == '1'">
                        力<img src="/../img/ken.png" alt="">
                        </div>
                        <div v-else-if="task.categories_id == '2'">
                        魔力<img src="/../img/mahou.png" alt="">
                        </div>
                        <div v-else-if="task.categories_id == '3'">
                        知力<img src="/../img/know.png" alt="">
                        </div>
                    </div>

                    <div class="each-task__state">
                        <button class="main-button" @click ="clicked(task)">戻す</button>
                        <button class="main-button" v-on:click="onActive(task)">メモをみる</button>
                        <button class="sub-button" @click ="deletetask(task)">削除</button>
                    </div>
                    <div class="each-task__difficult" v-html="forDifficult(task.difficult)"></div>
                    <span class="each-task__time">投稿日時：{{task.created_at}}</span>
                </div>
            </div>
        </div>

        
    </section>
</template>

<style>

.fade-enter-active{
    animation:fade-in .5s;
}

.fade-leave-active{
    animation:fade-in .5s reverse;
}

.bounce-enter-active {
  animation: bounce-in .5s;
}
.bounce-leave-active {
  animation: bounce-in .5s reverse;
}


</style>


<script>
    import Taskform from './TaskFormComponent.vue';//ok

    export default {
        data(){
            return{
                defaultTasks:[],//fetchtaskで取得する全て。ここは変更しない
                tasks:[],//これが毎回出てくる情報
                filterFlg:false,
                up:false,//task実施時の表示
                upcategory:"",
                newTask:false,
                activeItem:null,
                tasknum:0
            }
        },
        components:{
            Taskform
        },
        created(){
            this.firsttasks();
            //this.firsttasks(this.defaultTasks);
        },
        mounted(){//apiから一覧を取得
            //console.log(this.$store.state.user);
            //console.log("moutedです");
            this.fetchtasks();
        },
        updated(){
            //console.log("updated");
            //console.log(this.defaultTasks);
            //console.log(this.tasks);
        },
        methods:{
            firsttasks(){//すべてのtasksを取得
            let url = '/api/tasklist/';
            if(this.$store.state.user.id){
                url = url + this.$store.state.user.id;
            }
            //console.log(url);//ユーザー情報ある場合は数字が末尾に入る
                axios
                .get(url)
                .then(response => (this.defaultTasks = response.data))
            },
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
                console.log(this.defaultTasks);
                this.tasks = [];
                console.log("beforeTasks");
                    for(var i in this.defaultTasks){
                        if(this.defaultTasks[i].done == 0){
                            this.tasks.push(this.defaultTasks[i]);
                        }
                    }
            },
            afterTasks(){//実施済のtasksを取得
                this.tasks = [];
                console.log("afterTasks");
                    for(var i in this.defaultTasks){
                        if(this.defaultTasks[i].done == 1){
                            this.tasks.push(this.defaultTasks[i]);
                        }
                    }
            },
            addTask(){//task追加の表示
                this.newTask = !this.newTask;
            },
            clicked(task){
                //コントローラー側で処理
                let target = task.id;
                let self = this;
                console.log('/tasks/change/' + target);//コントローラー側でtaskの難しさをみて変更
                axios.post('/tasks/change/' + target)
                .then(function(responce){
                    self.fetchtasks();
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
                        self.upcategory = "";
                        self.up = true;
                        self.upcategory = tempcategory;
                        setTimeout(self.fadeout, 1000);
                    }
                    self.$store.commit('message/setContent',{//メッセージを入れ
                        content: tempmsg
                    })
                    self.$store.dispatch('register');//更新しておく

                })
            },
            deletetask(task){
                //コントローラー側で処理
                let target = task.id;
                let self = this;
                if( confirm("削除してもよろしいでしょうか？") ) {
                    let tempmsg = task.title + "を削除しました。";
    
                    console.log('/tasks/delete/' + target);
                    axios.post('/tasks/delete/' + target)
                    .then(function(responce){
                        self.fetchtasks();
                        self.$store.commit('message/setContent',{
                            content: tempmsg })
                    })
                } else {
                    alert("削除をやめました。");
                }
            },
            fadeout:function() {
                this.up = false;
                
            },
            onActive(task){//メモを見る処理
                if(this.activeItem === task){
                    this.activeItem = null;
                }else{
                    this.activeItem = task;
                }
            },
            forDifficult(e){//難易度表示
                let star = "";
                for(let i = 1; i <= e; i++){
                    star = star + "<i class='fas fa-star fontawasome-star'></i>";
                }
                return star;
            }
            

        },
        watch:{
            tasks:{
                async handler (){
                    await this.mounted;
                },
                immediate:true
            }
        }

 
    }
</script>