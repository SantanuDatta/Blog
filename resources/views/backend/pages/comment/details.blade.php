@extends('backend.layout.template')

@section('title', 'Moderate Comment')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-compose-outline tx-70 lh-0"></i>
        <div>
            <h4>View Comment</h4>
            <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-b-20">
            <div class="col-sm-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white">
                        Moderate Comment
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                        <form action="{{ route('comment.update', $comment->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">From Post</label>
                                        <input type="text" class="form-control" value="{{ $comment->post->title }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Commenter Name<span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Please Input Category Name" value="{{ $comment->user->name }}"
                                            readonly disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Comment</label>
                                        <textarea name="description" class="form-control">{{ $comment->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Commenter Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $comment->user->email }}" readonly disabled>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Approve Comment<span class="tx-danger">*</span></label>
                                        <select name="status" class="form-control" id="">
                                            <option value="" hidden>Please Select Status</option>
                                            <option value="1" @if ($comment->status == 1) selected @endif>Approve
                                            </option>
                                            <option value="0" @if ($comment->status == 0) selected @endif>
                                                Disapprove</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="editComment" class="btn btn-teal float-right">Moderate
                                            Comment</button>
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
