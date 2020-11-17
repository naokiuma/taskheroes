<template>
    <section class="section-tasks">
        <h2>タスク一覧</h2>
        <table class="tasks-wrapper">
            <tr v-for="task in tasks" :key="task.id" v-bind:class="{done: task.done}">

                <th class="task-title">{{task.title}}</th>
                <td class="task-body">{{task.body}}</td>
                
                <td class="task-body">
                    <div v-if="task.categories_id == '1'">
                    力
                    </div>
                    <div v-else-if="task.categories_id == '2'">
                    B
                    </div>
                    <div v-else-if="task.categories_id == '3'">
                    C
                    </div>
                </td>
                
                <td class="task-state">{{ task.state }}
                    <input type="checkbox" v-model="task.done" @change="changed(task)">
                </td>
                <td class="button">
                    <!-- 削除ボタンのモック -->
                    <button>削除</button>
                </td>

            </tr>
        </table>        
    </section>
</template>

<style scoped>
.done{
  background-color: gray;
}

</style>


<script>

    export default {
        //props:['id'],
        data(){
            return{
                tasks:[]
            }
        },
        
        mounted(){//apiから一覧を取得
            console.log("mounted");
            axios
            .get('/api/tasklist')
            .then(response => (this.tasks = response.data))
            //console.log(this.tasks);
        },
        methods:{
            changed(task){
                console.log("changed");   
                let target = task.id;
                console.log(target);
                console.log("今trueなのでfalseに変えます。")
                console.log('/tasks/change/' + target);
                axios.post('/tasks/change/' + target)
                .then(function(responce){
                    console.log("変更に成功しました。");
            })
        }
        }

 
    }
</script>