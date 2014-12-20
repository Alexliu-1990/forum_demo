@extends('layouts.master')

@section('body')
    <div class="row forum textposition">
        <div class="six columns">
            <div class="content">
                <a href="{{URL::route('catgory.show', array(1))}}">板块1</a>
                <p>描述1</p>
            </div>
        </div>
        <div class="six columns">
            <div class="content">
                <a href="{{URL::route('catgory.show', array(2))}}">板块2</a>
                <p>描述2</p>
            </div>
        </div>
    </div>
    <div class="row forum textposition">
        <div class="six columns">
            <div class="content">
                <a href="{{URL::route('catgory.show', array(3))}}">板块3</a>
                <p>描述3</p>
            </div>
        </div>
        <div class="six columns">
            <div class="content">
                <a href="{{URL::route('catgory.show', array(4))}}">板块4</a>
                <p>描述4</p>
            </div>
        </div>
    </div>
    <hr>
@stop
