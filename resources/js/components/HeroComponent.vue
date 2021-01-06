<template>
    　<section class="section-status animate__animated animate__bounceInRight">
        <h3 class="mypage-heading">ステータス</h3>
        <h4>{{this.$store.state.user.name}}</h4>
        <div class="section-parameters">
            
            <div class="parameters-wrapper">
                <ul>
                    <li class="parameters parameters-lv">レベル</li>
                    <li class="parameters parameters-hp">ヒットポイント</li>
                    <li class="parameters parameters-power">力</li>
                    <li class="parameters parameters-magic">魔力</li>
                    <li class="parameters parameters-wisdom">知識</li>
                    <li class="parameters parameters-xp">経験値</li>
                    
                </ul>
                <div class="gauges-group">
                    <div class="gauges" v-bind:style="{ width:num.value * 6 + 'px' }"
                        v-for="(num, index) in parameters" :key="index">
                        <div class="gauges-bar">{{num.value}}</div>
                        
                    </div>
                    {{xp}}/10
                    
                </div>

            <!--アイテムコンポーネント
            <div class="each-item" v-for ="item in items" :key="item.index">
                <div v-on:click="showItemDetail(item)">
                    //ハッシュを満たしていればアイテム表示
                    <img v-if="haveItem(item.name) == 1" v-bind:src="item.image" alt="">
                    <img v-else src="/img/items/what.png">
                    
                </div>

                <aside class="each-item__detail" v-show="itemShow == item.id">
                    <h4>{{item.name}}</h4>
                    <p>{{item.description}}</p>
                    <p v-if="haveItem(item.name) == 1">取得条件：{{item.requirement}}</p>
                    <p v-else>取得条件：不明</p>
                </aside>
            </div>

            -->
                    

                

 
            </div>
            <div class="parameters-hero">
                <img src="/img/fighter.png" alt="">
            </div>
        </div>
        <Taskform />
    　</section>
</template>



<script>
    export default {
        data(){
            return{
                parameters:[
                    {id:"lv",value:this.$store.state.user.lv},
                    {id:"hp", value:this.$store.state.user.hp},
                    {id:"power",value:this.$store.state.user.power},
                    {id:"magic",value:this.$store.state.user.magic},
                    {id:"wisdom",value:this.$store.state.user.wisdom},
                    {id:"xp",value:this.$store.state.user.xp}
                    
                ],
            }
        },


        mounted(){
            console.log("hero mounted");
            //console.log(this.parameters);
            this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
            this.fetchusers();
            this.$store.commit('message/setContent',{
                        content: "ステータス画面を開きました。"
                    })
        },
        methods:{
            fetchusers(){                
                console.log("ユーザーの能力");
                //console.log(this.$store.state.user.power);
            }
        },
        watch:{
            parameters:{
                async handler(){
                    await this.mounted;
                },
                immediate:true
            }

        }
    }
</script>


