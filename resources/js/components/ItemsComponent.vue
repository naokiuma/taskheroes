<template>
    <section>
        <h3 class="mypage-heading">アイテム一覧</h3>
        <div class="items-wrapper">
            <div class="each-item" v-for ="item in items"  :key="item.index">
                <h4>{{item.name}}</h4>
                <p>{{item.description}}</p>
            </div>

        </div>
        
        {{ items }}
    </section>
</template>

<script>

    export default {
        data(){
            return{
                items:[]
            }
        },
        mounted(){//apiから一覧を取得
            this.fetchitems();
        },
        methods:{
            fetchitems(){
                let url = '/api/itemlist/';
                if(this.$store.state.user.id){
                    url = url + this.$store.state.user.id;
                }
                //console.log(url);//ユーザー情報ある場合は数字が末尾に入る
                axios
                .get(url)
                .then(response => (this.items = response.data))
            }
        },
        watch:{
            items:{
                async handler (){
                    await this.mounted;
                },
                immediate:true
            }
        }
    }



</script>