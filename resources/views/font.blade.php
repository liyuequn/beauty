<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token"  content="{{ csrf_token() }}">
    <title>beauty-font</title>
    <style>
        html,body{
            margin:0px;
            height:100%;
            font-family:
                    /*"Helvetica Neue",Helvetica,"PingFang SC",*/
                    "Hiragino Sans GB"
                    /*"Microsoft YaHei","微软雅黑",Arial,sans-serif;*/
        }
    </style>
</head>
<body>
        <div id="app" style="height:100%;">
            <router-view></router-view>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>