@extends('backend.layout.template')

@section('title', 'Edit Reader')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-compose-outline tx-70 lh-0"></i>
        <div>
            <h4>Edit Reader</h4>
            <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-b-20">
            <div class="col-sm-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white">
                        Edit Reader
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                        <form action="{{ route('reader.update', $reader->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Editor Name<span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control form-control-dark" name="name"
                                            value="{{ $reader->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Editor Email</label>
                                        <input type="email" name="email" class="form-control form-control-dark"
                                            value="{{ $reader->email }}" disabled readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Select A Role</label>
                                        <select name="role" class="form-control form-control-dark" id="">
                                            <option value="" hidden>Please Select Role</option>
                                            <option value="1" @if ($reader->role == 1) selected @endif>Admin
                                            </option>
                                            <option value="2" @if ($reader->role == 2) selected @endif>Editor
                                            </option>
                                            <option value="3" @if ($reader->role == 3) selected @endif>Reader
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select A Status<span class="tx-danger">*</span></label>
                                        <select name="status" class="form-control form-control-dark" id="">
                                            <option value="" hidden>Please Select Status</option>
                                            <option value="1" @if ($reader->status == 1) selected @endif>Active
                                            </option>
                                            <option value="0" @if ($reader->status == 0) selected @endif>
                                                Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="editreader" class="btn btn-teal float-right">Update
                                            Reader</button>
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
