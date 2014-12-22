@extends('layouts.master')

@section('body')
    <div class="row forum">
        <form action="{{URL::route('posts.store')}}" method="post">
          <div class="row">
              <label for="subject">主题</label>
              <input class="u-full-width" type="text" placeholder="主题" id="subject" name="subject" {{(Input::old('subject')) ? 'value= "' . Input::old('subject') . '"' : ''}}>
          </div>
          <div class="row">
              <label for="catgory">分类</label>
              <select class="u-full-width" name="catgory">
                <option value="1" {{(Input::old('catgory'))==1 ? 'selected= "selected"' : ''}}>类别1</option>
                <option value="2" {{(Input::old('catgory'))==2 ? 'selected= "selected"' : ''}}>类别2</option>
                <option value="3" {{(Input::old('catgory'))==3 ? 'selected= "selected"' : ''}}>类别3</option>
                <option value="4" {{(Input::old('catgory'))==4 ? 'selected= "selected"' : ''}}>类别4</option>
              </select>
          </div>
          <div class="row">
          <label for="editor">正文</label>
          <textarea class="u-full-width" placeholder="正文内容 …" id="editor" name="body" >{{Input::old('body') ? Input::old('body'):'' }}</textarea>
          </div>
          <div class="row">
          <input class="button-primary check" type="submit" value="提交">
          </div>
        </form>
    </div>

    @stop
    @section('inclu')
     <script>
        $(document).ready(function(){

            $('input.check').click(function(e){
                subject         = $('input#subject').val();
                body            = $('textarea#editor').val();

                if(subject == '' || body == ''){

                    alert('主题/正文为空!');
                    e.preventDefault();
                }

            });
          /**
             *
             *富文本编辑器初始化
             *
             */

            var editor = new Simditor({
                  textarea: $('#editor'),
                  upload: {
                    url: '{{URL::route('upload')}}',
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
