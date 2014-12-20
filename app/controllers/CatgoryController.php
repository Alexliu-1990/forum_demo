<?php

class CatgoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /catgory
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('catgory.catgory');
	}

	/**
	 * Display the specified resource.
	 * GET /catgory/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$posts       = Catgory::find($id)->post()->orderBy('created_at', 'desc')->paginate(10);
        $posts->getFactory()->setViewName('pagination::slider');
        return View::make('posts.index', compact('posts'));
	}

}
