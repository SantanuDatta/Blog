@extends('backend.layout.template')

@section('title', 'New Post')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-plus-outline tx-70 lh-0"></i>
        <div>
        <h4>Add A Post</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-b-20">
            <div class="col-sm-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white">
                        Post
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Post Title</label>
                                        <input type="text" class="form-control" name="title" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Post Description</label>
                                        <textarea id="long_desc" name="description" class="form-control"></textarea>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Select Categories</label>
                                        <select class="form-control js-example-basic-multiple" multiple="multiple" name="category_id[]" id="">
                                            @foreach ($parentCat as $pCat)
                                                <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
                                                @foreach (App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCat->id)->get() as $childCat)
                                                    <option value="{{ $childCat->id }}">&#8627; {{ $childCat->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tags</label>
                                        <input type="text" name="tags" class="form-control" data-role="tagsinput" placeholder="Features Included With The Car Like AC, Seats">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Feature Post?</label><br>
                                        <div class="form-check-inline">
                                            <label class="rdiobox rdiobox-info">
                                                <input name="is_featured" type="radio" value="1">
                                                <span>Enable</span>
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="rdiobox rdiobox-info">
                                                <input name="is_featured" type="radio" value="0" checked>
                                                <span>Disable</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select A Status<span class="tx-danger">*</span></label>
                                        <select name="status" class="form-control form-control-dark" id="">
                                            <option value="" hidden>Please Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Add Blog Thumbnail</label>
                                        <div class="ht-200 bg-black-2 d-flex align-items-center justify-content-center">
                                            <input type="file" name="image" id="image"
                                            class="inputfile" data-multiple-caption="{count} files selected" multiple>
                                            <label for="image" class="if-outline if-outline-info">
                                                <i class="icon ion-ios-upload-outline tx-24"></i>
                                                <span>Choose files...</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <button type="submit" name="addPost" class="btn btn-teal float-right">Add New Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection