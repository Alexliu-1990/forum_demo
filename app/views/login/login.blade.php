@extends('layouts.master')

@section('body')
<div class="row form">
    <form action="{{URL::to('login')}}" method="post" id="loginForm">
        邮箱:
        <input  type="text" placeholder="email" name="email" id="loginEmail"><br>
        密码:
        <input type="password" placeholder="password" name="password" id="loginPassword"><br>
        <input type="checkbox" name="checkbox" id="loginCheck">自动登录&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   <a href="{{URL::to('forgot')}}">忘记密码?</a><br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="登录" id="loginSubmit">
    </form>
</div>
@stop

@section('inclu')
    <script>
        $(document).ready(function(){
            /**
             *
             *防止csrf攻击的token
             *
             */

            $(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').attr('value')
                    }
                });
            });

             /*
             *登录过程的ajax函数
             *
             */

            $('#loginSubmit').click(function(e){
                e.preventDefault();

                email       = $('#loginEmail').val();
                password    = $('#loginPassword').val();
                checkbox    = $('#loginCheck').prop('checked') ? 1 : 0; //用prop取checkbox的checked
                url         = $('#loginForm').attr('action');

                $.ajax({

                    type:   'post',
                    url:    url,
                    data:   'email='+email+'&password='+password+'&checkbox='+checkbox,
                    success:function(data){
                        if(data.success == true){
                            window.location = '/';
                        }
                        else
                        {
                            alert(data.errors);
                        }
                    }
                });
            });


        });
    </script>
@stop
