@extends('backend.layout.template')

@section('title', 'All Comments')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-list-outline tx-70 lh-0"></i>
        <div>
        <h4>Comments Overview</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-b-20">
            <div class="col-sm-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white">
                        Manage All Comments
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">
                        
                        @if ($comments->count() == 0)
                            <div class="alert alert-info">No Comments Have Been Posted Yet!</div>
                        @else
                            <table id="data" class="table table-striped table-hover table-bordered table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th scope="col">#SL.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Commented At</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <th scope="row">{{ $serial }}</th>
                                            <td>{{ $comment->user->name }}</td>
                                            <td>{{ $comment->description }}</td>
                                            <td>{{ $comment->created_at->toFormattedDateString() }}</td>
                                            <td>@if ($comment->status == 0)
                                                <span class="badge badge-secondary">Disapproved</span>
                                            @elseif ($comment->status == 1)
                                                <span class="badge badge-primary">Approved</span>
                                            @endif</td>
                                            <td>
                                                <div class="btn-group action-bar" role="group">
                                                    <a href="{{ route('comment.show', $comment->id) }}"><i class="fas fa-eye"></i></a>
                                                    <a href="" data-toggle="modal" data-target="#softdelete-{{ $comment->id }}"><i class="fas fa-trash"></i></a>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade effect-scale modal-dark" id="softdelete-{{ $comment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content bd-0">
                                                        <div class="modal-header pd-x-20">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Comment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body pd-20">
                                                            <p class="mg-b-5">
                                                                Are You Sure You Want To Delete This Comment Permanently!
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="delete" class="btn btn-danger btn-sm" >Delete Comment</button>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $serial++; @endphp
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