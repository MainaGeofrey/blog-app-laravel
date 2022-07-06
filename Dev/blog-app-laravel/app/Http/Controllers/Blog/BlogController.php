<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Blog::orderBy('id', 'desc')->paginate(7);
        return view('blog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blog.create');
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
            return redirect()->route('blog.create')->withErrors($validator)->withInput();
        }
        else
        {
            $blog = Blog::create($input);
            return redirect()->route('blog.index')->with('success', 'Post created successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog  $blog)
    {
        //
        return view('blog.show', compact('blog'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
        return view('blog.edit', compact('blog'));

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
            return redirect()->route('blog.edit', $blog->id)->withErrors($validator)->withInput();
        }
        else
        {
            $blog->update($input);
            return redirect()->route('blog.index')->with('success', 'Post updated successfully');
        }
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
        return redirect()->route('blog.index')->with('success', 'Post deleted successfully');
    }
}
