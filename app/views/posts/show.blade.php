@extends('layouts.master')

@section('body')
    <div class="row forum">
            <a class="button button-primary write" href="{{URL::route('posts.create')}}">发帖</a>
    </div>
    @if(isset($post))

    <div class="row forum show">
         <h5>{{$post->subject}}</h5>
        @if(Auth::check())
        @if((Auth::user()->id == $post->user->id)||(Auth::user()->admin == 1))
        <div class="row">
            <div class="two columns">
            <h6>{{link_to_route('posts.edit', '编辑', [$post->id])}}</h6>
            </div>
            <div class="two columns">
            <form action="{{URL::route('posts.destroy', [$post->id])}}" method="post">
            <h6><a href="#" onclick="$(this).closest('form').submit()">删除</a></h6>
                <input type="hidden" name="_method" value="delete">
            </form>
            </div>
        </div>
        @endif
        @endif
        <hr>
        <div class="row showhr">
            <div class="six columns">
                <p>作者:{{$post->user->nickname}}</p>
            </div>
            <div class="six columns">
                <p>发表时间:{{$post->created_at}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <p>{{$post->body}}</p>
        </div>
       <hr>
        <div class="row">
            <h5>评论数 ({{$post->comment_count}}):</h5>
        </div>
        @if($post->comment_count != 0)
        @foreach($comments as $comment)
            <hr>
            <div class="row">
                <div class="six columns">
                    <p>作者:{{$comment->user->nickname}}</p>
                </div>
                @if(Auth::check()&&Auth::user()->id != $comment->user_id)
                <div class="six columns">
                    <p>发表时间:{{$comment->created_at}}</p>
                </div>
                @else
                <div class="four columns">
                    <p>发表时间:{{$comment->created_at}}</p>
                </div>
                <div class="two columns">
                    <form action="{{URL::route('comments.destroy', [$comment->id])}}" method="post">
                    <a href="#" onclick="$(this).closest('form').submit()">删除</a>
                    <input type="hidden" name="_method" value="DELETE">
                    </form>
                </div>
                @endif
                <hr>
                <div class="row">
                    <p>{{$comment->content}}</p>
                </div>
            </div>
        @endforeach
        <div class="row">
        {{$comments->links()}}
        </div>
        @endif
        <form action="{{URL::route('comments.store')}}" method="post" id="commentForm">
            <div class="row">
                <label for="Message">留言</label>
                    <textarea class="u-full-width" placeholder="请发表您的看法..." id="Message" name="Message"></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{$post->id}}" id="post_information">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input class="button-primary" type="submit" value="提交" id="commentSubmit">
        </form>
    </div>
    @else
    <div class="row forum">
        <p>页面不存在！</p>
    </div>
    @endif
@stop
