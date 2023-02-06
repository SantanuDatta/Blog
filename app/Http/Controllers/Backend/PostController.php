<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('title', 'asc')->get();
        return view('backend.pages.post.manage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCat = Category::where('is_parent', 0)->orderBy('name', 'asc')->get();
        return view('backend.pages.post.create', compact('parentCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title        = $request->title;
        $post->slug         = Str::slug($request->title);
        $post->description  = $request->description;
        $post->category_id  = implode(",", $request->category_id);
        $post->tags         = $request->tags;
        $post->is_featured  = $request->is_featured;
        $post->user_id      = $request->user_id;
        $post->status       = $request->status;
        if($request->image){
            $image = $request->file('image');
            $img = rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('backend/img/post-images/' . $img);
            $imageResize = Image::make($image);
            $imageResize->fit(600, 380)->save($location);
            $post->image = $img;
        }

        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'New Post Added!',
        );

        $post->save();
        return redirect()->route('post.manage')->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            
            $request->file('upload')->move(public_path('backend/img/post-images/'), $fileName);
    
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('backend/img/post-images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(!is_null($post)){
            $explodeCat = explode(",", $post->category_id);
            $parentCat = Category::orderBy('name', 'asc')->where('is_parent', 0)->where('status', 1)->get();
            return view('backend.pages.post.edit', compact('post', 'parentCat'),['cat' => $explodeCat]);
        }else{
            //404
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title        = $request->title;
        $post->slug         = Str::slug($request->title);
        $post->description  = $request->description;
        $post->category_id  = implode(",", $request->category_id);
        $post->tags         = $request->tags;
        $post->is_featured  = $request->is_featured;
        $post->status       = $request->status;
        if($request->image){
            if(File::exists('backend/img/post-images/' . $post->image)){
                File::delete('backend/img/post-images/' . $post->image);
            }
            
            $image = $request->file('image');
            $img = rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('backend/img/post-images/' . $img);
            $imageResize = Image::make($image);
            $imageResize->resize(600, 380)->save($location);
            $post->image = $img;
        }
        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'Post Has Been Updated!',
        );
        $post->save();
        return redirect()->route('post.manage')->with($notification);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!is_null($post)){
            if(File::exists('backend/img/post-images/' . $post->image)){
                File::delete('backend/img/post-images/' . $post->image);
            }
            $notification = array(
                'alert-type'    => 'error',
                'message'       => 'Post Has Been Removed!',
            );
            $post->delete();
            return redirect()->route('post.destroy')->with($notification);
        }else{
            //404
        }
    }
}
