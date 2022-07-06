<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    //add image
    public function addImage()
    {
        return view('blog.image-upload');
    }

    public function storeImage(Request $request) {

        dd($request->all());
        if ($request->hasFile('image'))
        {try {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('image');
            $fileName = date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('public/images'), $fileName);
            $data['image'] = $fileName;

            //$data['status'] = 'success';
            //$data['message'] = 'Image uploaded successfully';

            //$data->save();
            return redirect()->route('blog.index')->with('success', 'Image uploaded successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }

        }

    }

    public function viewImage() {
        return view('blog.view-image');

    }
}
