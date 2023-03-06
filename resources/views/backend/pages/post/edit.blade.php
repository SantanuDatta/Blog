@extends('backend.layout.template')

@section('title', 'Edit Post')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-plus-outline tx-70 lh-0"></i>
        <div>
            <h4>Edit Post</h4>
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
                                <form action="{{ route('post.update', $post->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Post Title</label>
                                        <input type="text" class="form-control" value="{{ $post->title }}"
                                            name="title" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Post Description</label>
                                        <textarea id="long_desc" name="description" class="form-control">{{ $post->description }}</textarea>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Select Categories</label>
                                    <select name="category_id[]" class="form-control js-example-basic-multiple"
                                        multiple="" id="">
                                        <option value="" hidden>Select A Category</option>
                                        @foreach ($parentCat as $pCat)
                                            <option value="{{ $pCat->id }}"
                                                @if (in_array($pCat->id, $cat)) selected @endif>{{ $pCat->name }}
                                            </option>
                                            @foreach (App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCat->id)->get() as $childCat)
                                                <option value="{{ $childCat->id }}"
                                                    @if (in_array($childCat->id, $cat)) selected @endif>&#8627;
                                                    {{ $childCat->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tags</label>
                                    <input type="text" class="form-control" value="{{ $post->tags }}" name="tags"
                                        id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Feature Post?</label><br>
                                    <div class="form-check-inline">
                                        <label class="rdiobox rdiobox-info">
                                            <input name="is_featured" type="radio" value="1"
                                                @if ($post->is_featured == 1) checked @endif>
                                            <span>Enable</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="rdiobox rdiobox-info">
                                            <input name="is_featured" type="radio" value="0"
                                                @if ($post->is_featured == 0) checked @endif>
                                            <span>Disable</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Select A Status<span class="tx-danger">*</span></label>
                                    <select name="status" class="form-control form-control-dark" id="">
                                        <option value="" hidden>Please Select Status</option>
                                        <option value="1" @if ($post->status == 1) selected @endif>Active
                                        </option>
                                        <option value="0" @if ($post->status == 0) selected @endif>Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Add Blog Thumbnail</label>
                                    @if (!is_null($post->image))
                                        <img src="{{ asset('backend/img/post-images/' . $post->image) }}"
                                            class="img-fluid mx-auto d-block" style="width:75%;"><br>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input">
                                            <label
                                                class="custom-file-label custom-file-label-primary">{{ $post->image }}</label>
                                        </div>
                                    @else
                                        <img src="{{ asset('backend/img/post-images/post_default.png') }}"
                                            class="img-fluid mx-auto d-block"><br>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input">
                                            <label class="custom-file-label custom-file-label-primary">Upload Blog
                                                Image</label>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <button type="submit" name="updatePost" class="btn btn-teal float-right">Update
                                        Post</button>
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
