<template>
    <div style="text-align: right;">
        <el-form ref="commentForm" :rules="rules" :model="commentForm">
            <el-form-item prop="comment">
                <el-input type="textarea" v-model="commentForm.comment"   cols="30" :rows="5" style="width:100%;"></el-input>
            </el-form-item>
            还剩余{{ num }}个字
        </el-form>
        <button class="btn btn-primary" @click="submit('commentForm')" style="margin-top:20px;">提交</button>
    </div>
</template>
<script>
    import bus from '../../busEvent'
    export default{
        data(){
            return {
                num:100,
                article_id:0,
                commentForm:{
                    comment:'',
                },
                rules:{
                    comment:[
                        { required: true, message: '评论不能为空', trigger: 'blur' },
                        {
                            min: 1, max: 100, message: '长度在 1 到 100 个字符', trigger: 'blur'
                        }
                    ]
                },

            }
        },
        watch:{
            'commentForm.comment':'countVal',
        },
        methods:{
            submit(formName){
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        var userInfo =sessionStorage.getItem('userInfo');
                        let param = {
                            username:JSON.parse(userInfo).name,
                            user_id:sessionStorage.getItem('userId'),
                            comment:this.commentForm.comment,
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
                            this.commentForm.comment= '';
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            countVal(val){
                this.num = 100 - val.length;
                console.log(this.num)
            }
        },
        mounted(){
            var arr = window.location.href.split('/');
            this.article_id = parseInt(arr[arr.length-1]);
        }

    }
</script>
