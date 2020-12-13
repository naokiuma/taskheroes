<template>
    　<section class="section-status">
        <h2 class="heading-skew">ステータス</h2>
        <div class="section-parameters">
            <h3>Level：{{ lv }}</h3>
            <div class="parameters-wrapper">
                <ul>
                    <li class="parameters parameters-hp">ヒットポイント</li>
                    <li class="parameters parameters-power">力</li>
                    <li class="parameters parameters-magic">魔力</li>
                    <li class="parameters parameters-wisdom">知識</li>
                    <li class="parameters parameters-xp">経験値</li>
                </ul>
                
                <div class="gauges-group">
                        <div class="gauges" v-bind:style="{ width:num.value * 5 + 'px' }"
                            v-for="(num, index) in parameters" :key="index">
                            <div class="gauges-bar">{{num.value}}</div>

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
                parameters:[
                    {id:"hp", value:"50"},
                    {id:"power",value:this.$store.state.user.power},
                    {id:"magic",value:"8"},
                    {id:"wisdom",value:"3"},
                    {id:"xp",value:"2"}
                    
                ],
                lv:"7"
            }
        },


        mounted(){
            console.log("hero mounted");
            //console.log(this.parameters);
            //this.$store.dispatch('register');//storeのactionをこちらでdispatchしログインしているかを返す
            this.fetchusers();
        },
        methods:{
            fetchusers(){                
                console.log("ユーザーの能力");
                //console.log(this.parameters[1]["power"]);//これで取得できる
                //this.parameters[1]["power"] = this.$store.state.user.power;
                console.log(this.$store.state.user.power);
                
            }
        }
    }
</script>