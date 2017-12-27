<template>
    <div style="text-align: right;">
        <el-input type="textarea" v-model="comment"  cols="30" :rows="5" style="width:100%;"></el-input>
        <button class="btn btn-primary" @click="submit()" style="margin-top:20px;">提交</button>
    </div>
</template>
<script>
    import bus from '../../busEvent'
    export default{
        data(){
            return {
                article_id:0,
                comment:'',
            }
        },
        methods:{
            submit(){
                let param = {
                    user_id:sessionStorage.getItem('userId'),
                    comment:this.comment,
                    article_id:this.article_id
                }
                var _this = this;
                axios.post('/api/v1/article/comment',param).then((res)=>{
                    _this.$message({
                        showClose: true,
                        message: '评论成功',
                        type: 'success'
                    });
                    bus.$emit('commentEvent');
                })
            },

        },
        mounted(){
            var arr = window.location.href.split('/');
            this.article_id = parseInt(arr[arr.length-1]);
        }

    }
</script>
