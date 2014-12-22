@extends('layouts.master')

@section('body')
<div class="row form">
    <form action="{{URL::to('register')}}" method="post" id="registerForm">
        邮箱:
        <input type="text" placeholder="email" name="email" id="registerEmail"><br>
        密码:
        <input type="password" placeholder="password" name="password" id="registerPassword"><br>
        确认:
        <input type="password" placeholder="password confirm" name="password_confirm" id="registerPasswordConfirm"><br>
        昵称:
        <input type="text" placeholder="nickname" name="nickname" id="registerNickname"><br>
        姓氏:
        <input type="text" placeholder="first name" name="first_name" id="registerFirstname"><br>
        名氏:
        <input type="text" placeholder="last name" name="last_name" id="registerLastname"><br>
        性别:
        <input type="checkbox" value="1" checked="checked" id="registerGender">男 <input type="checkbox" value="0"> 女<br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="注册" id="registerSubmit">
    </form>
</div>
@stop
