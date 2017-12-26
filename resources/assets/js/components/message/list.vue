<template>
    <div>

        <el-alert style="margin-bottom: 10px;"
                v-for="(item,index) in messages" :key="index"
                :title="item.send_from_name"
                :type="item.status==1?'info':'success'"
                @click.native="readMessage(item)"
        >
            {{item.content}}
        </el-alert>

    </div>
</template>
<script>
    export default {
        data(){
          return {
            messages:[],
            read:'success',
          }
        },
        methods:{
            readMessage(item){
                axios.get('/readMessage/'+item.id).then((res)=>{
                    this.receiveMessage();
                });
            },
            receiveMessage(){
                axios.get('/receiveMessage/1/sys/erp').then((res)=>{
                    this.messages = res.data;
                });
            }
        },
        mounted(){
          var   _this = this;
            setTimeout(function(){
                _this.receiveMessage();
            },100);
            setInterval(function(){
                _this.receiveMessage();
            },8000);
        }
    }
</script>