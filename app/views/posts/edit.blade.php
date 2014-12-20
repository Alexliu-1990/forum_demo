@extends('layouts.master')

@section('body')
    <div class="row forum">
        <div class="row">
            <a class="button write" href="#">返回</a>
        </div>
        <form action="{{URL::route('posts.update', [$post->id])}}" method="post">
          <div class="row">
              <label for="subject">主题</label>
              <input class="u-full-width" type="text" placeholder="主题" id="subject" name="subject" {{isset($post) ? 'value= "' . $post->subject . '"' : ''}}>
          </div>
          <div class="row">
              <label for="catgory">分类</label>
              <select class="u-full-width" name="catgory">
                <option value="1" {{ (isset($post)&&$post->cat_id==1)? 'selected= "selected"' : ''}}>类别1</option>
                <option value="2" {{ (isset($post)&&$post->cat_id==2)? 'selected= "selected"' : ''}}>类别2</option>
                <option value="3" {{ (isset($post)&&$post->cat_id==3)? 'selected= "selected"' : ''}}>类别3</option>
                <option value="4" {{ (isset($post)&&$post->cat_id==4)? 'selected= "selected"' : ''}}>类别4</option>
              </select>
          </div>
          <div class="row">
          <label for="editor">正文</label>
          <textarea class="u-full-width" placeholder="正文内容 …" id="editor" name="body" >{{isset($post) ? $post->body :'' }}</textarea>
          </div>
          <div class="row">
          <input type="hidden" name="_method" value="PATCH" />
          <input class="button-primary" type="submit" value="提交">
          </div>
        </form>
    </div>

    @stop
    @section('inclu')
     <script>
        $(document).ready(function(){
          /**
             *
             *富文本编辑器初始化
             *
             */

            var editor = new Simditor({
                  textarea: $('#editor'),
                  upload: {
                    url: '',
                    params: null,
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '正在上传文件，如果离开上传会自动取消'
                  },
                  pasteImage: true,
                  defaultImage: '../images/image.png',
                });


        });
        </script>

    @stop
