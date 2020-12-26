<template>
    　<section class="section-status">
        <h2>ステータス</h2>
        <h3>{{this.$store.state.user.name}}</h3>
        <div class="section-parameters">
            
            <div class="parameters-wrapper">
                <ul>
                    <li class="parameters parameters-lv">レベル</li>
                    <li class="parameters parameters-hp">ヒットポイント</li>
                    <li class="parameters parameters-power">力</li>
                    <li class="parameters parameters-magic">魔力</li>
                    <li class="parameters parameters-wisdom">知識</li>
                    <!--<li class="parameters parameters-xp">経験値</li>-->
                </ul>
                <div class="gauges-group">
                        <div class="gauges" v-bind:style="{ width:num.value * 6 + 'px' }"
                            v-for="(num, index) in parameters" :key="index">
                            <div class="gauges-bar">{{num.value}}</div>

                        </div>
                </div>
 
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
                    {id:"wisdom",value:this.$store.state.user.wisdom}
                    //{id:"xp",value:this.$store.state.user.xp}
                    
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
                //console.log(this.parameters[1]["power"]);//これで取得できる
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


