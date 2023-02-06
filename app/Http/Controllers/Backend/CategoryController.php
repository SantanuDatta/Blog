<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('is_parent', 0)->orderBY('name', 'asc')->get();
        return view('backend.pages.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCat = Category::where('is_parent', 0)->get();
        return view('backend.pages.category.create', compact('parentCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name         = $request->name;
        $category->slug         = Str::slug($request->name);
        $category->is_parent    = $request->is_parent;
        $category->description  = $request->description;
        $category->is_featured  = $request->is_featured;
        $category->status       = $request->status;

        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'New Category Added!',
        );

        $category->save();
        return redirect()->route('category.manage')->with($notification);
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
        $category = Category::find($id);
        if(!is_null($category)){
            $parentCat = Category::orderBy('name', 'asc')->where('is_parent', 0)->get();
            return view('backend.pages.category.edit', compact('category', 'parentCat'));
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
        $category = Category::find($id);
        $category->name         = $request->name;
        $category->slug         = Str::slug($request->name);
        $category->is_parent    = $request->is_parent;
        $category->description  = $request->description;
        $category->is_featured  = $request->is_featured;
        $category->status       = $request->status;
        
        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'Category Updated Successfully!',
        );

        $category->save();
        return redirect()->route('category.manage')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!is_null($category)){
            $notification = array(
                'alert-type'    => 'error',
                'message'       => 'Category Has Been Removed!',
            );
            $category->delete();
            return redirect()->route('category.manage')->with($notification);
        }else{
            //404
        }
    }
}
