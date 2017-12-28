<template>
    <div>
        <el-form ref="signUpForm" :model="signUpForm" :rules="rules" action="/signUp">
            <el-form-item label="用户名" prop="email">
                <el-input     v-model="signUpForm.email" placeholder="邮箱"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="password">
                <el-input type="password"  v-model="signUpForm.password"  placeholder="密码"></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="confirm_password">
                <el-input type="password"   v-model="signUpForm.confirm_password" placeholder="确认密码"></el-input>
            </el-form-item>
            <el-form-item label="验证码" prop="verifyCode">
                <el-input  v-model="signUpForm.verifyCode" placeholder="随意填"></el-input>
            </el-form-item>
        </el-form>
        <button type="submit" @click="submit('signUpForm')"  class="btn btn-primary" style="width:100%">提交</button>

    </div>
</template>
<script>
    export default{
        data(){
            var validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    if (this.signUpForm.confirm_password !== '') {
                        this.$refs.signUpForm.validateField('confirm_password');
                    }
                    callback();
                }
            };
            var validatePass2 = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'));
                } else if (value !== this.signUpForm.password) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            return {
                signUpForm:{
                    email:null,
                    password:null,
                    confirm_password:null,
                    verifyCode:null,
                },
                rules: {
                    email: [
                        { required: true, message: '请输入用户名', trigger: 'blur' },
                        { min: 3, max: 20, message: '长度在 3 到 5 个字符', trigger: 'blur' }
                    ],
                    password: [
                        {validator: validatePass,},
                        {  required: true, message: '请输入密码', trigger: 'blur' },
                        { min: 6, max: 20, message: '长度在 6 到 20 个字符', trigger: 'blur' }
                    ],
                    confirm_password: [
                        {validator: validatePass2,},
                        {  required: true, message: '再次输入密码', trigger: 'blur' },
                        { min: 6, max: 20, message: '长度在 6 到 20 个字符', trigger: 'blur' }
                    ],
                    verifyCode: [
                        { required: true, message: '请输入验证码', trigger: 'blur' },
                        { min: 6, max: 6, message: '长度在 6 到 20 个字符', trigger: 'blur' }
                    ],

                }

            }
        },
        methods:{
            submit(formName){
                var _this = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        var param = {
                            email:this.signUpForm.email,
                            password:this.signUpForm.password,
                            confirm_password:this.signUpForm.confirm_password,
                            verifyCode:this.signUpForm.verifyCode,
                        }
                        axios.post('/signUp',param).then((res)=>{
                            if(res.status==200){
                                _this.$message({
                                    showClose: true,
                                    message: '注册成功',
                                    type: 'success'
                                });
                            }
                        }).catch((error)=>{
                            _this.$message({
                                showClose: true,
                                message: error.response.data.message,
                                type: 'error'
                            });
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });

            }
        }
    }
</script>