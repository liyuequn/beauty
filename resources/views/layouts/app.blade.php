<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap@next/dist/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" href="{{asset('images/icon/Beauty.png')}}" type="image/x-icon"/>
    <script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <!-- Add this after vue.js -->
    <script src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
    <script src="//unpkg.com/tether@latest/dist/js/tether.min.js"></script>
    <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
    <title>@yield('title')</title>
    <style>
        .navbar-brand{border: 1px solid #f0f0f0;height: 66px!important;position: fixed;top:0;z-index:2;background-color: white;  }
        .login{float: right;width: 60px;border-radius:20px;color: white; margin-left: 10px;margin-right: 10px;}
        .register{float: right;width: 60px;border-radius:20px;color: white;margin-left: 10px;margin-right: 10px; }
        body{background-color: white;}
        .modal-dialog{margin: 130px auto;width: 90%;}
        .input-group{
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @section('header')
        <header class="nav-justified navbar-brand" id="header">
            <div class="container" >
                <a href="{{url('/')}}">Beauty</a>
                <a href="javascript:;" class="btn btn-primary login" @click="login">登录</a>
                <a href="javascript:;" class="btn btn-primary register" @click="register">注册</a>
            </div>
            <!-- Modal Component -->
            <b-modal ref="my_modal" id="modal1" title="登录" @ok="submit" @shown="clearName">
                <form @submit.stop.prevent="submit">
                    <b-input-group left="用户">
                        <b-form-input type="text" placeholder="输入用户名" v-model="name"></b-form-input>
                    </b-input-group>
                    <b-input-group left="密码">
                        <b-form-input type="password" placeholder="输入密码" v-model="password"></b-form-input>
                    </b-input-group>
                </form>
            </b-modal>
        </header>
    @show
    <div class="container" style="margin-top: 66px;">
        @yield('content')
    </div>
    <script>
        var header = new Vue({
            el: '#header',
            data: {
                message: 'Hello Vue!',
                name:'',
                password:'',
            },
            methods:{
                login(){
                    this.$refs.my_modal.show();
                },
                clearName() {
                    this.name = '';
                    this.password = '';
                },
                submit(e) {
                    if (!this.name) {
                        alert('Please enter your name');
                        return e.cancel();
                    }
                },
                register(){

                }
            }
        })
    </script>
</body>
</html>