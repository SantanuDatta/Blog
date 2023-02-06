<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('id', 'desc')->get();
        return view('backend.pages.comment.manage', compact('comments'));
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
        $comment = new Comment();
        $comment->description   = $request->description;
        $comment->post_id       = $request->post_id;
        $comment->user_id       = $request->user_id;

        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'Your Comment Is Being Moderated Please Be Patient!',
        );

        $comment->save();
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        if(!is_null($comment)){
            return view('backend.pages.comment.details', compact('comment'));
        }else{

        }
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
        $comment = Comment::find($id);
        $comment->description = $request->description;
        $comment->status = $request->status;

        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'Comment Update SuccessFully!',
        );

        $comment->save();

        return redirect()->route('comment.manage')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(!is_null($comment)){
            $notification = array(
                'alert-type'    => 'error',
                'message'       => 'Comment Has Been Deleted!',
            );
            $comment->delete();
        }else{
            //404
        }
        
        return redirect()->route('comment.manage')->with($notification);
    }
}
