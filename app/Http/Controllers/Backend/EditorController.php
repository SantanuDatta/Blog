<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editors = User::where('role', 1)->orWhere('role', 2)->orderBy('name', 'asc')->get();
        return view('backend.pages.editor.manage', compact('editors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.editor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $editor = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'status'    => $request->status,
        ]);

        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'New Editor Registered!',
        );

        event(new Registered($editor));
        return redirect()->route('editor.manage')->with($notification);
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
        $editor = User::find($id);
        if(!is_null($editor)){
            return view('backend.pages.editor.edit', compact('editor'));
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
        $editor = User::find($id);
        $editor->name       = $request->name;
        $editor->role       = $request->role;
        $editor->status     = $request->status;
        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'Editor Has Been Updated!',
        );
        $editor->save();

        return redirect()->route('editor.manage')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editor = User::find($id);
        if(!is_null($editor)){
            $notification = array(
                'alert-type'    => 'error',
                'message'       => 'Editor Has Been Removed!',
            );
            $editor->delete();
            
        }else{
            //404
        }
        return redirect()->route('editor.manage')->with($notification);
    }
}
