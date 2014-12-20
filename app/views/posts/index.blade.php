@extends('layouts.master')

@section('body')
        <div class="row forum">
            <a class="button button-primary write" href="{{URL::route('posts.create')}}">发帖</a>
        </div>
        <div class="row forum">
        <table class="u-full-width lineColor">
          <thead>
            <tr>
                <div class="row">
                  <div class="four columns"><th><a href="#">主题</a></th></div>
                  <div class="two columns"><th><a href="#">回复数</a></th></div>
                  <div class="two columns"><th><a href="#">最后回复时间</a></th></div>
                  <div class="two columns"><th><a href="#">发表时间</a></th></div>
                  <div class="two columns"><th><a href="#">作者</a></th></div>
                </div>
            </tr>
          </thead>
          <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{link_to_route('posts.show', $post->subject, $post->id)}}</td>
                    <td>{{$post->comment_count}}</td>
                    <td>@if($post->comment_count != 0)
                        {{$post->comment()->orderBy('created_at', 'desc')->first()->created_at}}
                        @else
                         -
                        @endif
                    </td>
                    <td>{{explode(" ", $post->created_at)[0]}}</td>
                    <td>{{$post->user()->first()->nickname}}</td>
                    </div>
                </tr>
                @endforeach
          </tbody>
        </table>
        <div class="row">
        {{$posts->links()}}
        </div>
   </div>

@stop

@section('inclu')
    <script>
        $(document).ready(function(){
            $('.lineColor tr:even').css('backgroundColor','#EEE');
        });
    </script>
@stop
