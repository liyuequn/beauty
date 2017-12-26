@extends('layouts.app')
@section('content')
    <style>
        .error{
            color: #3798CF;
        }
    </style>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
        <form id="signUpForm" method="post" action="/signUp">
            <div class="form-group">
                <label for="email">用户名</label>
                <input type="email"  class="form-control" id="email" name="email" placeholder="邮箱">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="密码">
            </div>
            <div class="form-group">
                <label for="confrim_password">确认密码</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="确认密码">
            </div>
            <div class="form-group">
                <label for="verifyCode">验证码</label>
                <input type="password" class="form-control" id="verifyCode" name="verifyCode" placeholder="随意填">
            </div>
            <button type="submit"   class="btn btn-primary" style="width:100%">提交</button>
        </form>
    </div>
    <div class="col-md-3">

    </div>
    <script>
        $().ready(function() {
            // 在键盘按下并释放及提交后验证提交表单
            $("#signUpForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    verifyCode:{
                        required: true,
                    },
                },
                messages: {
                    username: {
                        required: "请输入用户名",
                        minlength: "用户名必需由两个字母组成"
                    },
                    password: {
                        required: "请输入密码",
                        minlength: "密码长度不能小于 6 个字母"
                    },
                    confirm_password: {
                        required: "请输入密码",
                        minlength: "密码长度不能小于 6 个字母",
                        equalTo: "两次密码输入不一致"
                    },
                    email: "请输入一个正确的邮箱",
                },
                submitHandler: function() {
                    var data = $('#signUpForm').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "/signUp",
                        data: data,// 要提交的表单
                        success: function (msg) {
                            window.open('/');
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
            })

        });
    </script>
@endsection
