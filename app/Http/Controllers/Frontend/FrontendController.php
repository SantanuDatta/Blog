<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $latestPosts = Post::orderBy('id', 'desc')->take(4)->get();
        $cDetails = Category::where('is_featured', 1)->where('status', 1)->get();
        return view('frontend.pages.home', compact('latestPosts', 'cDetails'));
    }

    public function contact()
    {
        return view('frontend.pages.info.contact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Search
    public function searchPost(Request $request)
    {
        $search = $request->searchContent;
        $posts = Post::orWhere('title', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%')->orWhere('tags', 'like', '%' . $search . '%')->orderBy('id', 'desc')->where('status', 1)->paginate(6);
        $latestPosts = Post::orderBy('id', 'desc')->take(4)->get();
        return view('frontend.pages.posts.search', compact('posts', 'search', 'latestPosts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogs()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        $latestPosts = Post::orderBy('id', 'desc')->take(4)->get();
        $cDetails = Category::where('is_featured', 1)->where('status', 1)->get();
        return view('frontend.pages.posts.posts', compact('posts', 'latestPosts', 'cDetails'));
    }

    public function singlePost($slug)
    {
        $latestPosts = Post::orderBy('id', 'desc')->take(4)->get();
        $post = Post::where('slug', $slug)->first();
        return view('frontend.pages.posts.single-post', compact('post', 'latestPosts'));
    }

    public function categoryPost($slug)
    {
        $latestPosts = Post::orderBy('id', 'desc')->take(4)->get();
        $cDetails = Category::where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.posts.category', compact('cDetails', 'latestPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
