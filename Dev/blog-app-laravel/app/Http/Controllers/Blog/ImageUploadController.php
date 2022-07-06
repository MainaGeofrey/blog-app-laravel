<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    //
    public function imageUpload()
    {
        return view('blog.image-upload');
    }

    public function imageUploadPost(Request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/blogs'), $imageName);

        $request->image->storeAs('images', $imageName);

        return redirect()->route('blog.index')->with('success', 'Image uploaded successfully');
    }
}
