<?php

class CommentController extends \BaseController {

    public function __construct() {

        $this->beforeFilter('auth');
        $this->beforeFilter('csrf', array('only' => 'store'));
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /comment
	 *
	 * @return Response
	 */
	public function store()
    {
        $Message    = Input::get('Message');
        $post_id    = Input::get('post_id');
        $data       = ['Message' => $Message, 'Post_id' => $post_id];
        $rules      = ['Message' => 'required', 'Post_id' => 'required'];

        $validator  = Validator::make($data, $rules);

        if(Request::ajax()){
            if($validator->fails()){
                return Response::json(['success'=>false, 'errors'=>$validator->getMessageBag()->first()]);
            }

            $post   = Post::where('id', '=', $post_id)->first();
            $comment= new Comment;
                $comment->content   = $Message;
                $comment->user_id   = Auth::user()->id;
                $comment->post_id   = $post_id;


            if($comment->save()){
                $post->increment('comment_count');
                Auth::user()->increment('comment_count');
                return Response::json(['success'=>true, 200]);
            }
            else
            {
                return Response::json(['success'=>false, 'errors'=>'未知错误']);
            }

        }
	}



	/**
	 * Remove the specified resource from storage.
	 * DELETE /comment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
        $comment    = Comment::find($id);
        $post       = $comment->post;
        $comment->delete();
        $post->decrement('comment_count');
        return Redirect::route('posts.show',[$post->id]);
	}

}
