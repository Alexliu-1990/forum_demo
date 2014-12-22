@extends('layouts.master')

@section('body')
<div class="row form">
    <form action="{{URL::to('forgot')}}" method="post" id="retrieveForm">
        邮箱:
        <input  type="text" placeholder="email" name="email" id="retrieveEmail"><br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="发送" id="retrieveSubmit">
    </form>
</div>
@stop
