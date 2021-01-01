<template>
    <section>
        <h3 class="mypage-heading">アイテム一覧</h3>
        <div class="items-wrapper">
            <div class="each-item" v-for ="item in items" :key="item.index">
                <h4>{{item.name}}</h4>
                <p>{{item.description}}</p>
            </div>

        </div>

        <h3 class="mypage-heading">アイテム一覧</h3>
        <div class="items-wrapper">
            <div class="each-item" v-for ="myitem in myitems" :key="myitem.index">
                <h4>{{myitem.name}}</h4>
                <p>{{myitem.description}}</p>
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
                have:[]//ハッシュ
                /*
                Items[
                    {name:'all',items:[]},
                    {name:'myitems',items:[]}
                ]
                */
            }
        },
        created(){
            this.fetchItems();
            this.fetchMyItems();

            
        },
        mounted(){//apiから一覧を取得
            console.log("mounted");
            //console.log(this.items);
            //this.have = this.items;
            //console.log(this.have);
            /*for(let i = 0; i < this.myitems.length; i++){
                if(this.have[this.myitems[i].name] == undefined){
                    this.have[this.myitems[i].name] = 1;
                }
            }
            */
                
        },
        methods:{
            fetchItems(){
                axios
                .get('/api/itemlist/')
                .then(response => (
                    this.items = response.data
                    ))
            },
            fetchMyItems(){//並列処理！！！
                let url = '/api/itemlist/';
                let self = this;
                if(this.$store.state.user.id){
                    url = url + this.$store.state.user.id;
                }
                axios
                .get(url)
                .then(response => (this.myitems = response.data))//myitemsに情報を入れる。
                .then(function() {//myitemsの情報をhashに入れる
                     for(let i = 0; i < self.myitems.length; i++){
                        if(self.have[self.myitems[i].name] == undefined){
                        self.have[self.myitems[i].name] = 1;
                        }
                    }
                })
            },
            check(){

                console.log(this.items);
                console.log(this.myitems);
                console.log(this.have);
            }
            
        },
        watch:{
            myitems:{
                async handler (){
                    await this.mounted;
                },
                immediate:true
            }
        }
    }



</script>