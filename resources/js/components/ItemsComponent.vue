<template>
<div class="allItem-pages">
    <!--<img class="item-shopman" src="/img/items/shop.png" alt="">-->
    
    <div class="section-items animate__animated animate__bounceInRight">
        <h3 class="mypage-heading"><img class="eachPageImg" src="/img/items/shop.png" alt=""><span>アイテム一覧</span></h3>
        <div class="items-wrapper">
            <div class="each-item"  v-on:click="showItemDetail(item)" v-for ="item in items" :key="item.index">
                <div class="each-item-wrapper">
                    <!--<img v-bind:src="item.image" alt="">-->
                    <!--取得してないアイテムはクラス付与-->
                    <img v-if="haveItem(item.name) == 1" v-bind:src="item.image" alt="">
                    <img v-else class="beforeBuy-img" v-bind:src="item.image" alt="">

                    <div v-if="haveItem(item.name) == 1" class="have-item" alt=""><i class="fas fa-check"></i></div>
                </div>
                <!--<button @click="haveItem(item.name)">アイテムあるか</button>-->
            </div>        
        </div>  
    <!--
    <button @click="check()">ボタン</button>
    -->
    </div>

    <transition name="fade">
    <aside class="each-item__detail" v-show="itemShow >= 1">
            <h4>{{itemDetail.name}}</h4>
            <!--
            <img v-if="haveItem(itemDetail.name) == 1" v-bind:src="itemDetail.image" alt="">
            <img v-else src="/img/items/what.png">
            -->
            <p v-if="haveItem(itemDetail.name) == 1" v-bind:src="itemDetail.image" alt="">購入済み</p>
            <p v-else>¥ {{itemDetail.price}}</p>
            <span>{{itemDetail.description}}</span>

            <button v-show="haveItem(itemDetail.name) == 0" class="buy-button" v-on:click="confirmOrder()">購入</button>
            <div v-show="orderlastModal == true" class="lastchoise">
                <button class="confirmOrder-button" v-on:click="buyItem()">買う</button>
                <button class="cancel-button" v-on:click="cancelOrder()"><i class="fas fa-times"></i></button>
            </div>
            
            

            <button class="close-button" v-on:click="closeDetail()"><i class="fas fa-times"></i></button>
    </aside>
    </transition>
</div>
</template>

<style>
.left-enter-active{ animation:Left-in .2s; }
.left-leave-active{ animation:Left-in .2s reverse;}
.fade-enter-active{ animation:fade-in .2s; }
.fade-leave-active{ animation:fade-in .2s reverse;}
</style>


<script>
    export default {
        data(){
            return{
                items:[],//すべてのアイテム
                myitems:[],//自身の持つアイテム
                have:[],//ハッシュ
                itemShow:null,
                itemDetail:[],//選択中のアイテム
                orderlastModal:false
            }
        },
        created(){
            this.fetchMyItems();
            this.fetchItems();
        },
        mounted(){//apiから一覧を取得
            console.log("mounted");
            //this.fetchItems();
            
            this.$store.commit('message/setContent',{
                content: "ラッシャイ！"
            })
        },
        methods:{
            fetchItems(){
                axios
                .get('/api/itemlist/')
                .then(response => (
                    this.items = response.data//すべてのアイテムを取得
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
                .then(response => (this.myitems = response.data))//myitemsに自身のアイテムの情報を入れる。
                .then(function() {//myitemsの情報をhashに入れる
                     for(let i = 0; i < self.myitems.length; i++){
                        if(self.have[self.myitems[i].name] == undefined){
                        self.have[self.myitems[i].name] = 1;
                        }
                    }
                })
            },
            haveItem(val){//hashの中に含まれているならtrueを返す関数
                console.log("haveItemです");
                //console.log(this.have[val]);
                //console.log("-------");
                if(this.have[val] !== undefined){
                    return true;
                }else{
                    return false;
                }

            },
            showItemDetail(item){
                console.log(item.id);
                if(this.itemShow == item.id){
                    this.itemShow = null;
                    this.itemDetail = [];
                }else{
                    this.itemShow = item.id;
                    this.itemDetail = item;
                }
                console.log("itemShowに挿入されている数字" + this.itemShow);
            },
            closeDetail(){
                this.itemShow = null;
                this.itemDetail = [];
            },
            confirmOrder(){
                let choiseItemNumuber = this.itemDetail.id - 1;
                this.$store.commit('message/setContent',{
                    content: this.items[choiseItemNumuber].price + "ゴールドだ。まじで買うかい？"
                })
                this.orderlastModal = true;

            },
            buyItem(){//購入。
                let userMoney = this.$store.state.user.money;
                console.log("選択中" + this.itemDetail.id);
                let choiseItemNumuber = this.itemDetail.id - 1;//選択中アイテムのid
                //console.log("手持ちのおかね" + userMoney);
                //console.log("アイテムの値段" + this.items[choiseItemNumuber].price);
                //console.log(this.items);
                if(userMoney < this.items[choiseItemNumuber].price ){
                    this.$store.commit('message/setContent',{
                        content: "お金が足りないぜ。"
                        })
                }else{
                    console.log("お金あるよ");
                    //サーバーサイドでの処理
                    axios.post('/items/buy/' + this.itemDetail.id)
                    .then(function(responce){
                        console.log(responce);

                        })
                    this.$store.commit('message/setContent',{
                    content: "ありがとうよ！！"
                    })
                    setTimeout(this.$router.go({path: this.$router.currentRoute.path, force: true}), 4000);


                }
            },
            cancelOrder(){
                this.orderlastModal = false;
                 this.$store.commit('message/setContent',{
                        content: "まあまた考えてくれや。"
                        })
                this.itemShow = null;
                this.itemDetail = [];
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