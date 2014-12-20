<?php

class PostsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response

	public function index()
	{
        $posts          = Post::orderBy('id', 'desc')->paginate(10);

        $posts->getFactory()->setViewName('pagination::slider');
		return View::make('posts.index', compact('posts'));
	}
    */


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data           = array(
            'subject'   => Input::get('subject'),
            'cat_id'    => Input::get('catgory'),
            'body'      => Input::get('body')
        );
        $rules          = array(
            'subject'   => 'required|min:4',
            'cat_id'    => 'required',
            'body'      => 'required|min:8'
        );

        $validator      = Validator::make($data, $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data['user_id']= Auth::user()->id;
        $data['body']   = Purifier::clean($data['body'], 'body_check');

        $post           = Post::create($data);

        return Redirect::route('posts.show', $post->id);


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
    {
            $post       = Post::find($id);

            if($post){

                if($post->comment_count != 0){
                    $comments   = $post->comment()->orderBy('created_at', 'desc')->paginate(10);
                    $comments->getFactory()->setViewName('pagination::slider');
                } else {
                    $comments   = '暂无评论';
                }
                return View::make('posts.show', compact('post', 'comments'));
            }
            else{
                return Redirect::route('catgory.catgory');
            }
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post       = Post::find($id);
        if(Auth::user()->id != $post->user_id)
            return Redirect::to('/');
        return View::make('posts.edit', compact('post'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $post           = Post::find($id);
        //return Redirect::to('/')->with('setErrors', $post->id);
        if(Auth::user()->id == $post->user->id){
            $data           = array(
            'subject'   => Input::get('subject'),
            'cat_id'    => Input::get('catgory'),
            'body'      => Input::get('body')
            );
            $rules          = array(
            'subject'   => 'required|min:4',
            'cat_id'    => 'required',
            'body'      => 'required|min:8'
            );

            $validator      = Validator::make($data, $rules);
            if($validator->fails()){
                return Redirect::back()->withErrors()->withInput();
            }

            $data['body']   = Purifier::clean($data['body'], 'body_check');

            $post->subject  = $data['subject'];
            $post->cat_id   = $data['cat_id'];
            $post->body     = $data['body'];
            if($post->save()){

            return Redirect::route('posts.show', $post->id);
            }
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $post   = Post::find($id);
        $cat_id = $post->cat_id;
        $post->delete();
        return Redirect::route('catgory.show', array($cat_id));
	}

    /**
     *
     *处理上传的图片
     *
     */
    public function upload()
    {
        if(Input::file('upload_file')->isValid()){
            $image          = Input::file('upload_file');
            $name           = $image->getClientOriginalName();
            $extension      = $image->getClientOriginalExtension() ?: 'png';
            $subPath        = '/images/uploads/' . Auth::user()->id . '/' . md5(date("Ym", time()));
            $destinationPath= public_path() . $subPath;
            $newName        = md5(date("d", time())) . '.' . $extension;
            $image->move($destinationPath, $newName);

            $file_path      = route('homepage') . $subPath . '/' . $newName;
            return Response::json(['success'=>true, 'msg' => '上传成功', 'file_path' => $file_path]);
        }
        else {
            return Response::json(['success'=>false, 'msg' => '上传失败', 'file_path' => '']);
        }
    }

}
