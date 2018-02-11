<template>
    <div>
        <form id="signUpForm" method="post" >
            <div class="form-group">
                <label>用户名</label>
                <input type="email"  class="form-control" v-model="logForm.username" name="email" placeholder="邮箱">
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" class="form-control" v-model="logForm.password" name="password" placeholder="密码">
            </div>
        </form>
        <button type="submit" @click="login"  class="btn btn-primary" style="width:100%">登录</button>
    </div>

</template>
<script>
    export default{
        data(){
            return{
                logForm:{
                    password:'',
                    username:'',
                }

            }
        },
        methods:{
            login(){
                var _this = this;
                axios.post('/login', this.logForm).then(function (response) {
                    sessionStorage.setItem('access_token',response.data.access_token)
                    sessionStorage.setItem('refresh_token',response.data.refresh_token)
                    sessionStorage.setItem('token_type',response.data.token_type)
                    _this.$message({
                        showClose: true,
                        message: '登录成功',
                        type: 'success'
                    });
                    _this.logining = false;
                    window.axios.defaults.headers.common['Authorization'] = response.data.token_type+' '+response.data.access_token;
                    axios.get('/api/v1/user').then((res)=>{
                        sessionStorage.setItem('userInfo',JSON.stringify(res.data));
                        sessionStorage.setItem('userId',res.data.id);
                    }).catch((error)=>{

                    })
//                    window.location.href="/";
                }).catch(function (error) {
                    if(error.response.status==500){
                        _this.$message.error('系统错误');
                    }else if(error.response.status==401){
                        _this.$message.error('密码错误');
                    } else if(error.response.status==403){
                        _this.$message.error('用户不存在');
                    }else{
                        _this.$message.error('错误未知');
                    }
                })
            }

        },
        mounted(){
        }
    }
</script>