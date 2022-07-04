<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends BaseController

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogs = Blog::all();
        return $this->successResponse(BlogResource::collection($blogs), 'Posts fetched successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $input ['user_id'] = auth()->user()->id;

        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(['error' => $validator->errors()], 422);
        }

        $blog = Blog::create($input);
        return $this->successResponse(new BlogResource($blog), 'Post created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return $this->errorResponse(['error' => 'Post not found'], 404);
        }
        return $this->successResponse(new BlogResource($blog), 'Post fetched successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(['error' => $validator->errors()], 422);

        }

        $blog->title = $input['title'];
        $blog->content = $input['content'];
        $blog->description = $input['description'];
        $blog->save();

        return $this->successResponse(new BlogResource($blog), 'Post updated successfully', 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
        $blog->delete();
        return $this->successResponse(new BlogResource($blog), 'Post deleted successfully', 200);
    }

}
