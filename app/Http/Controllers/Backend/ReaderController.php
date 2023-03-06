<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = User::Where('role', 3)->orderBy('name', 'asc')->get();
        return view('backend.pages.reader.manage', compact('readers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.reader.create');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $reader = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'status'    => $request->status,
        ]);

        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'New Reader Registered!',
        );

        event(new Registered($reader));
        return redirect()->route('reader.manage')->with($notification);
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
        $reader = User::find($id);
        if (!is_null($reader)) {
            return view('backend.pages.reader.edit', compact('reader'));
        } else {
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
        $reader = User::find($id);
        $reader->name       = $request->name;
        $reader->role       = $request->role;
        $reader->status     = $request->status;
        $notification = array(
            'alert-type'    => 'success',
            'message'       => 'Reader Has Been Updated!',
        );
        $reader->save();

        return redirect()->route('reader.manage')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reader = User::find($id);
        if (!is_null($reader)) {
            $notification = array(
                'alert-type'    => 'error',
                'message'       => 'Reader Has Been Removed!',
            );
            $reader->delete();
        } else {
            //404
        }
        return redirect()->route('reader.manage')->with($notification);
    }
}
