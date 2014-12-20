@extends('layouts.master')

@section('body')
<div class="row form">
    <form action="{{URL::to('forgot-password')}}" method="post" id="changePasswordForm">
        新密码:
        <input type="password" placeholder="new password" name="password" id="changePassword"><br>
        请确认:
        <input type="password" placeholder="password confirm" name="password_confirm" id="passwordConfirm"><br>
        <input type="hidden" name="code" value="{{$code}}" id="change_code">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="确认" id="changePasswordSubmit">
    </form>
</div>
@stop
