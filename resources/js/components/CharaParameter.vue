<template>
    　<section class="section-status">
        <h1 class="heading-skew">ステータス</h1>
        <div class="section-parameters">
            <h3>Level</h3>
            <div class="parameters-wrapper">
                <ul>
                    <li class="parameters parameters-hp">ヒットポイント</li>
                    <li class="parameters parameters-heart">体力</li>
                    <li class="parameters parameters-power">力</li>
                    <li class="parameters parameters-speed">速さ</li>
                    <li class="parameters parameters-knowledge">知恵</li>
                </ul>
                <div class="gauges-group">
                    <div class="gauges" v-bind:style="{ width:num.value * 10 }" v-for="(num, index) in parameters" :key="index">
                        {{num.value}}
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
            {id:"hp", value:"20"},
            {id:"heart",value:"4"},
            {id:"power",value:"8"},
            {id:"speed",value:"3"},
            {id:"knowledge",value:"2"}
            
        ]
    }
    },
    mounted() {
        console.log(this.$store.state)
        //store.commit('increment')
        console.log('chara mounted.');
    }
}


</script>