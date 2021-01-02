<template>
    <section>
        <h3 class="mypage-heading">アイテム一覧</h3>
        <div class="items-wrapper">
            <div class="each-item" v-for ="item in items" :key="item.index">
                <div v-on:click="showItemDetail(item)">
                
                    <img v-if="haveItem(item.name) == 1" v-bind:src="item.image" alt="">
                    <img v-else src="/img/items/what.png">
                
                </div>

                <div v-show="itemShow == item.id">
                    <h4>{{item.name}}</h4>
                    <p>{{item.description}}</p>
                    <p v-if="haveItem(item.name) == 1">取得条件：{{item.requirement}}</p>
                    <p v-else>取得条件：不明</p>
                </div>
                <!--<button @click="haveItem(item.name)">アイテムあるか</button>-->
            </div>

        </div>

        <button @click="check()">ボタン</button>
    </section>
</template>


<script>

    export default {
        data(){
            return{
                items:[],//元々
                myitems:[],//元々
                have:[],//ハッシュ
                itemShow:null
            }
        },
        created(){
            this.fetchItems();
            this.fetchMyItems();

            
        },
        mounted(){//apiから一覧を取得
            console.log("mounted");
            this.fetchItems();
            this.fetchMyItems();
            
            //console.log(this.items);
            //console.log(this.have);
        },
        methods:{
            fetchItems(){
                axios
                .get('/api/itemlist/')
                .then(response => (
                    this.items = response.data
                    ))
            },
            fetchMyItems(){//並列処理でhashも作成
                let url = '/api/itemlist/';
                let self = this;
                if(this.$store.state.user.id){
                    url = url + this.$store.state.user.id;
                }
                axios
                .get(url)//並列処理でhashも作成
                .then(response => (this.myitems = response.data))//myitemsに情報を入れる。
                .then(function() {//myitemsの情報をhashに入れる
                     for(let i = 0; i < self.myitems.length; i++){
                        if(self.have[self.myitems[i].name] == undefined){
                        self.have[self.myitems[i].name] = 1;
                        }
                    }
                })
            },
            haveItem(val){
                //hashの中に含まれているならtrueを返す
                console.log("haveItemです");
                console.log(this.have);
                console.log(val);
                console.log(this.have[val]);
                console.log("-------");
                
                if(this.have[val] !== undefined){
                    return true;
                }else{
                    return false;
                }

            },
            showItemDetail(item){
                console.log("ここが見える");
                console.log(item.id);
                if(this.itemShow == item.id){
                    this.itemShow = null;
                }else{
                    console.log("通る？");
                    this.itemShow = item.id;
                }
                console.log(this.itemShow);
                
            },
            check(){
                console.log(this.items);
                console.log(this.myitems);
                console.log(this.have);
            }
            
        }
        /*
        watch:{
            myitems:{
                async handler (){
                    await this.mounted;
                },
                immediate:true
            }
        }
        */
    }



</script>