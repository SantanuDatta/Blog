@extends('backend.layout.template')

@section('title', 'All Posts')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-list-outline tx-70 lh-0"></i>
        <div>
        <h4>Posts</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-b-20">
            <div class="col-sm-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white">
                        Manage All Posts
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                        
                        @if ($posts->count() == 0)
                            <div class="alert alert-info">No Post Have Been Posted Yet!</div>
                        @else
                            
                            <table id="data" class="table table-striped table-hover table-bordered table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th scope="col">#SL.</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Featured</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($posts as $post)
                                        @if (Auth::user()->role == 2 && Auth::user()->id == $post->user_id)

                                            <tr>
                                                <th scope="row">{{ $serial }}</th>
                                                <td>{{ $post->title }}</td>
                                                <td>
                                                    @foreach (explode(",", $post->category_id) as $cat)
                                                        @foreach (App\Models\Category::where('id', $cat)->get() as $allCat)
                                                        <span class="badge badge-info">{{ $allCat->name }}</span>
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($post->is_featured == 0)
                                                        <span class="badge badge-secondary">Disabled</span>
                                                    @elseif ($post->is_featured == 1)
                                                        <span class="badge badge-primary">Enabled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($post->status == 0)
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @elseif ($post->status == 1)
                                                        <span class="badge badge-primary">Active</span>
                                                    @endif
                                                </td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>
                                                    <div class="btn-group action-bar" role="group">
                                                        <a href="" data-toggle="modal" data-target="#description-{{ $post->id }}"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('post.edit', $post->id) }}"><i class="fas fa-edit"></i></a>
                                                        <a href="" data-toggle="modal" data-target="#softdelete-{{ $post->id }}"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                    <!-- View Modal -->
                                                    <div class="modal fade effect-scale modal-dark" id="description-{{ $post->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content bd-0">
                                                            <div class="modal-header pd-x-20">
                                                            <h5 class="modal-title" id="viewModalLabel">Category Descripton</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body pd-20">
                                                                <p class="mg-b-5">
                                                                    @if (! $post->description)
                                                                        No Description Added
                                                                    @else
                                                                        {!! $post->description !!}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade effect-scale modal-dark" id="softdelete-{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                                        <div class="modal-content bd-0">
                                                            <div class="modal-header pd-x-20">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body pd-20">
                                                                <p class="mg-b-5">
                                                                    Are You Sure You Want To Delete This Post Permanently!
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" name="delete" class="btn btn-danger btn-sm" >Delete Post</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $serial++; @endphp
                                        @elseif (Auth::user()->role == 1)

                                            <tr>
                                                <th scope="row">{{ $serial }}</th>
                                                <td>{{ $post->title }}</td>
                                                <td>
                                                    @foreach (explode(",", $post->category_id) as $cat)
                                                        @foreach (App\Models\Category::where('id', $cat)->get() as $allCat)
                                                        <span class="badge badge-info">{{ $allCat->name }}</span>
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($post->is_featured == 0)
                                                        <span class="badge badge-secondary">Disabled</span>
                                                    @elseif ($post->is_featured == 1)
                                                        <span class="badge badge-primary">Enabled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($post->status == 0)
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @elseif ($post->status == 1)
                                                        <span class="badge badge-primary">Active</span>
                                                    @endif
                                                </td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>
                                                    <div class="btn-group action-bar" role="group">
                                                        <a href="" data-toggle="modal" data-target="#description-{{ $post->id }}"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('post.edit', $post->id) }}"><i class="fas fa-edit"></i></a>
                                                        <a href="" data-toggle="modal" data-target="#softdelete-{{ $post->id }}"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                    <!-- View Modal -->
                                                    <div class="modal fade effect-scale modal-dark" id="description-{{ $post->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content bd-0">
                                                            <div class="modal-header pd-x-20">
                                                            <h5 class="modal-title" id="viewModalLabel">Category Descripton</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body pd-20">
                                                                <p class="mg-b-5">
                                                                    @if (! $post->description)
                                                                        No Description Added
                                                                    @else
                                                                        {!! $post->description !!}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade effect-scale modal-dark" id="softdelete-{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                                        <div class="modal-content bd-0">
                                                            <div class="modal-header pd-x-20">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body pd-20">
                                                                <p class="mg-b-5">
                                                                    Are You Sure You Want To Delete This Post Permanently!
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" name="delete" class="btn btn-danger btn-sm" >Delete Post</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $serial++; @endphp
                                        @endif
                                        
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection