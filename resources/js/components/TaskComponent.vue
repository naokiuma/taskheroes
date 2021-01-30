<template>
    <section class="section-tasks animate__animated animate__bounceInRight">
        <!--レベルアップ演出。数秒で消える-->
        <section v-show="levelup" class="bg-task-fadein">
            <div class="fadein-wrapper">
                <div class="image-wrapper">
                </div>
            </div>
            <img src="/img/levelup.svg"> 
        </section>

        <h3 class="mypage-heading"><img class="eachPageImg" src="/img/steps/step2.png" alt=""><span>タスク一覧</span></h3>
        <div class="tasks-filter-btns">
            <button class="tasks-filter-btn" v-bind:class="{choicedtask:sortFilter == 'alltasks'}" @click="fetchtasks()">すべて</button>
            <button class="tasks-filter-btn" v-bind:class="{choicedtask:sortFilter == 'beforetasks'}" @click="beforeTasks()">未完了</button>
            <button class="tasks-filter-btn" v-bind:class="{choicedtask:sortFilter == 'aftertasks'}" @click="afterTasks()">実施済み</button>
            <button v-if="sortFilter == 'newtasks'" class="tasks-filter-btn" v-bind:class="{choicedtask:sortFilter == 'newtasks'}" @click="addTask()">閉じる</button>
            <button v-else-if="sortFilter != 'newtasks'" class="tasks-filter-btn" v-bind:class="{choicedtask:sortFilter == 'newtasks'}" @click="addTask()">新規タスク</button>

            <!--<button class="tasks-filter-btn" v-bind:class="{choicedtask:sortFilter == 'newtasks'}" @click="addTask()">新規タスク+</button>-->
        </div>
        <div class="tasks-wrapper">
            <transition name="bounce">
                <div class="newTask" v-show="newTask"><Taskform @formClose="addTask()" @formSubmit="reNewTasks()"></Taskform></div>
            </transition> 
            
            <transition name="bounce">
                <div v-show="up" class="taskupParameters">{{ upcategory }} がアップ！<i class="fas fa-arrow-up fontawasome-arrow "></i></div>
            </transition> 
            
            <div class="each-task card" v-for="task in tasks" :key="task.id">
                <!--表-->
                <div class="card__side card__side--front" v-bind:class="{ rotate: task.done }">
                    <div class="each-task__category">
                        <div class="each-task-Done-icon" @click ="clicked(task)" v-if="task.categories_id == '1'">
                            <img src="/../img/ken.png" alt="">
                        </div>
                        <div class="each-task-Done-icon" @click ="clicked(task)" v-else-if="task.categories_id == '2'">
                            <img src="/../img/mahou.png" alt="">
                        </div>
                        <div class="each-task-Done-icon" @click ="clicked(task)" v-else-if="task.categories_id == '3'">
                            <img src="/../img/know.png" alt="">
                        </div>
                    </div>
                    <div class="each-task__title_outer">
                        <div class="each-task__title_inner">{{task.title}}</div> 
                    </div>
                    <div class="each-task__state">
                        <button class="main-button" v-on:click="onActive(task)">詳細</button>
                        <button class="sub-button" @click ="deletetask(task)"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="each-task__difficult" v-html="forDifficult(task.difficult)"></div>
                    <span class="each-task__time">投稿日時：{{task.created_at}}</span>
                    
                    <transition name="bounce">
                    <aside class="each-task__detail" v-show="taskDetailShow == task.id">
                        <p>詳細メモ：{{task.body}}</p>
                    </aside>
                    </transition>
                </div>

                <!--裏-->
                <div class="card__side card__side--back" v-bind:class="{ rotate: !task.done }">
                    <div class="each-task__category">
                        <div class="each-task-Doned-icon" @click ="clicked(task)" v-if="task.categories_id == '1'">
                            <img src="/../img/ken.png" alt="">
                        </div>
                        <div class="each-task-Doned-icon" @click ="clicked(task)" v-else-if="task.categories_id == '2'">
                            <img src="/../img/mahou.png" alt="">
                        </div>
                        <div class="each-task-Doned-icon" @click ="clicked(task)" v-else-if="task.categories_id == '3'">
                            <img src="/../img/know.png" alt="">
                        </div>
                        <div class="star-wrapper">
                            <i class="fas fa-star star-icon-kirameki"></i>
                        </div>
                        <div class="star-wrapper2">
                            <i class="fas fa-star star-icon-kirameki"></i>
                        </div>
                    </div>
                        
                    <div class="each-task__title_outer">
                        <div class="each-task__title_inner">{{task.title}}</div> 
                    </div>
                    <p class="donetext">DONE!</p>

                    <div class="each-task__state">
                        <button class="main-button" v-on:click="onActive(task)">詳細</button>
                        <button class="sub-button" @click ="deletetask(task)"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="each-task__difficult" v-html="forDifficult(task.difficult)"></div>
                    <span class="each-task__time">投稿日時：{{task.created_at}}</span>

                    <transition name="bounce">
                    <aside class="each-task__detail" v-show="taskDetailShow == task.id">
                        <p>詳細メモ：{{task.body}}</p>
                    </aside>
                    </transition>
                    
                </div>
            </div>
        </div>

</section>
</template>
 

<style>
.fade-enter-active{ animation:fade-in .5s; }
.fade-leave-active{ animation:fade-in .5s reverse;}
.bounce-enter-active { animation: bounce-in .5s; }
.bounce-leave-active {animation: bounce-in .5s reverse;}
</style>


<script>
    import Taskform from './TaskFormComponent.vue';//ok
    
    export default {
        data(){
            return{
                defaultTasks:[],//fetchtaskで取得する全て。ここは変更しない
                tasks:[],//実際に表示するtasks。これをソートする
                filterFlg:false,
                up:false,//task実施時の表示
                upcategory:"",
                newTask:false,
                levelup:false,//レベルアップ時の表示
                taskDetailShow:null,
                sortFilter:"alltasks"//どのフィルターを通しているか
            }
        },
        components:{
            Taskform
        },
        created(){
            this.firstTasks();        
        },
        mounted(){//apiから一覧を取得
            //console.log("moutedです");
           this.fetchtasks();
           this.$store.commit('message/setContent',{
                content: "タスクを登録し、実施しましょう！"
            })
        },
        computed:{
            sortedTasks:function(){
                return this.sortedTasks;
            }
        },
        methods:{
            firstTasks(){//すべてのtasksを取得
                let url = '/api/tasklist/';
                if(this.$store.state.user.id){url = url + this.$store.state.user.id;}//ユーザー情報ある場合は数字が末尾に入る}
                let self = this;
                axios.get(url).then(function(response){
                    //console.log("うまくいったfirstTasks");
                    //console.log(response.data);
                    self.defaultTasks = response.data
                 })
                 return self.defaultTasks;
            },
            fetchtasks(){//すべてのtasksを取得
                //console.log("fetchTasks");
                this.newTask = false;
                this.sortFilter = "alltasks";
                let url = '/api/tasklist/';
                if(this.$store.state.user.id){
                    url = url + this.$store.state.user.id;//ユーザー情報ある場合は数字が末尾に入る
                    }
                axios.get(url).then(response => (
                    this.tasks = response.data
                ))
               return this.tasks;
            },
            beforeTasks(){//未実施のtasksを取得ここを改造
                //console.log("beforeTasks");
                this.newTask = false;
                this.sortFilter = "beforetasks";//ボタンアクティブ
                this.tasks = [];
                let temp = []
                    for(var i in this.defaultTasks){
                        if(this.defaultTasks[i].done == 0){
                            temp.push(this.defaultTasks[i]);
                        }
                    }
                this.tasks = temp;
                //console.log(this.tasks);
                //this.sortedTasks();
            },
            afterTasks(){//実施済のtasksを取得
                //console.log("afterTasks");
                this.newTask = false;
                this.sortFilter = "aftertasks";//ボタンアクティブ
                this.tasks = [];
                    for(var i in this.defaultTasks){
                        if(this.defaultTasks[i].done == 1){
                            this.tasks.push(this.defaultTasks[i]);
                        }
                    }
                    //console.log(this.tasks);
            },
            addTask(){//task追加の表示
            if(this.sortFilter == "newtasks"){
                this.sortFilter = null
            }else{
                this.sortFilter = "newtasks";//ボタンアクティブ
            }
                this.newTask = !this.newTask;
            },
            reNewTasks(){//子供で投稿があったら、または親で削除されたら検知
                this.firstTasks();
                this.fetchtasks();
            },
            clicked(task){
                //コントローラー側で処理
                let target = task.id;
                let self = this;
                let beforeUserLv = this.$store.state.user.lv;
                //console.log("ユーザーレベル前半" + beforeUserLv)
                //console.log('/tasks/change/' + target);//コントローラー側でtaskの難しさをみて変更
                axios.post('/tasks/change/' + target)
                .then(function(responce){
                    //console.log(responce.data[0].title + "がかえってきました");//タスク名が帰ってくる
                    //console.log(responce.data[1] + "がかえってきました");
                    //console.log("お金は" + responce.data[2] + "稼ぎました");
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
                        tempmsg = task.title + ' をキャンセルします。' + tempcategory + 'が下がります。'; 
                        }else{
                            tempmsg = task.title + ' を実施し、' + tempcategory + 'が上がりました。';
                            self.upcategory = "";
                            self.up = true;
                            self.upcategory = tempcategory;
                            setTimeout(self.fadeout, 1000);
                    }
                    self.$store.dispatch('register');//ユーザーパラメータの更新
                    self.firstTasks();
                    Vue.set(task,"done",responce.data[0].done);//対応taskのdoneに、帰ってきた値を入れる。
                    if(responce.data[1] > 0){
                        //console.log("レベルアップ");
                        tempmsg = tempmsg + "レベルアップしました！HPが"　+ responce.data[1] + "アップしました。" + responce.data[2] + "Gold手に入れました。"
                        self.levelup = true;
                        setTimeout(
                            function(){
                                self.levelup = false
                            },4000);
                    }else if(responce.data[1] < 0 && responce.data[2] > 0){//data[1]はrandom、レベルアップ時のhp上昇数。responce.data[2]はお金。
                        tempmsg = tempmsg + responce.data[2] + "Gold手に入れました。";                        
                    }
                    self.$store.commit('message/setContent',{//メッセージ
                        content: tempmsg
                    })
                    return task;
                })   
            },
            deletetask(task){
                //コントローラー側で処理
                let target = task.id;
                let self = this;
                if( confirm("削除してもよろしいでしょうか？この操作は取り消しできません。") ) {
                    let tempmsg = task.title + "を削除しました。";
                    //console.log('/tasks/delete/' + target);
                    axios.post('/tasks/delete/' + target)
                    .then(function(responce){
                        self.$store.commit('message/setContent',{
                            content: tempmsg })
                        self.reNewTasks();
                         
                    })
                    } else {
                    alert("削除しませんでした。");
                }
            },
            fadeout:function() {
                this.up = false;     
            },
            onActive(task){//メモを見る処理
            if(this.taskDetailShow == task.id){
                    this.taskDetailShow = null;
                }else{
                    //console.log("通るかtest");
                    this.taskDetailShow = task.id;
                }
            },
            modalResize(){ 
                let w = $(window).width();
                //console.log("w" + w);
                let h = $(window).height();
                let cw = $(".task-detail").outerWidth();
                //console.log("cw" + cw);
                let ch = $(".task-detail").outerHeight();
    
                //取得した値をcssに追加する
                $(".task-detail").css({
                        "left": ((w - cw)/2) + "px",
                        "top": ((h - ch)/2) + "px"
                });
            },
            forDifficult(e){//難易度star表示
                let star = "難易度：";
                for(let i = 1; i <= e; i++){
                    star = star + "<i class='fas fa-running fontawasome-difficult'></i>";
                }
                return star;
            }
        }
        
    
    }
    

</script>
