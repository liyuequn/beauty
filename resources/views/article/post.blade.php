@extends('layouts.app')
@section('title','写文章')
@section('content')
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">输入文章地址</label>
            <input name="article" id="article" class="form-control article" placeholder="输入文章地址">
        </div>
    </form>
    <button type="submit" id="submit" class="btn btn-default">Submit</button>
@endsection
@section('script')
    <script>
        $(function () {
            var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const access_token = sessionStorage.getItem('access_token');
            $("#submit").click(function () {
                var wechat_url = $("input[name='article']").val();
                if($("input[name='article']").val()!=''){
                    $.ajax('/'+"{{$url}}", {
                        type: 'post',
                        data: {url:wechat_url},
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Authorization':'Bearer '+ access_token},
                        success: function(res){
                            alert('保存成功')
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