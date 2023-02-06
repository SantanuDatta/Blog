@extends('backend.layout.template')

@section('title', 'New Editor')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-compose-outline tx-70 lh-0"></i>
        <div>
        <h4>Add An Editor</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-b-20">
            <div class="col-sm-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white">
                        Add An Editor
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                        <form action="{{ route('editor.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Editor Name<span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Please Input Editor Name" value="{{ old('name') }}" required autofocus>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Please Input Password" required autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select A Role</label>
                                        <select name="role" class="form-control" id="">
                                            <option value="2" hidden>Please Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Editor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Editor Email</label>
                                        <input type="email" name="email" class="form-control form-control-dark" placeholder="Please Input Email Address" value="{{ old('email') }}" required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Please Confirm Password" required>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select A Status<span class="tx-danger">*</span></label>
                                        <select name="status" class="form-control" id="">
                                            <option value="0" hidden>Please Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="addeditor" class="btn btn-teal float-right">Add New Editor</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection