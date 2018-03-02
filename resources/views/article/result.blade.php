@extends('layouts.app')
@section('title','写文章')
@section('content')
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">输入数值</label>
            <input name="num" id="article" class="form-control article" placeholder="输入数值">
        </div>
    </form>
    <button type="submit" id="submit" class="btn btn-default">Submit</button>
    <div class="list">
        <ul>

        </ul>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const access_token = sessionStorage.getItem('access_token');
            $("#submit").click(function () {
                $(".list >ul>li").remove();
                var num = $("input[name='num']").val();
                if($("input[name='num']").val()!=''){
                    $.ajax('/res', {
                        type: 'post',
                        data: {num:num},
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Authorization':'Bearer '+ access_token},
                        success: function(res){
                            console.log(res.length)
                            for(var i=0;i<res.length;i++){
                                $(".list >ul").append("<li>"+res[i].params+"</li>");
                            }
                        },
                        error:function (res) {
                            if(res.status!=200){
                                alert('失败')
                            }
                        }
                    });
                }else{
                    alert('不能为空')
                }

            })
        })
    </script>
@endsection