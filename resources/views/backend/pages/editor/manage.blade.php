@extends('backend.layout.template')

@section('title', 'All Editors')
@section('body-content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-list-outline tx-70 lh-0"></i>
        <div>
            <h4>Editors</h4>
            <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-b-20">
            <div class="col-sm-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white">
                        Manage All Editors
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 rounded-bottom">

                        @if ($editors->count() == 0)
                            <div class="alert alert-info">No Editors Have Been Uploaded Yet!</div>
                        @else
                            @if (Auth::check())
                                <table id="data"
                                    class="table table-striped table-hover table-bordered table-responsive-xl">
                                    <thead>
                                        <tr>
                                            <th scope="col">#SL.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach ($editors as $editor)
                                            <tr>
                                                <th scope="row">{{ $serial }}</th>
                                                <td>{{ $editor->name }}</td>
                                                <td>{{ $editor->email }}</td>
                                                <td>
                                                    @if ($editor->role == 1)
                                                        <span class="badge badge-warning">Admin</span>
                                                    @elseif ($editor->role == 2)
                                                        <span class="badge badge-info">Editor</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($editor->status == 0)
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @elseif ($editor->status == 1)
                                                        <span class="badge badge-primary">Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group action-bar" role="group">
                                                        <a href="" data-toggle="modal"
                                                            data-target="#description-{{ $editor->id }}"><i
                                                                class="fas fa-eye"></i></a>
                                                        <a href="{{ route('editor.edit', $editor->id) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a href="" data-toggle="modal"
                                                            data-target="#softdelete-{{ $editor->id }}"><i
                                                                class="fas fa-trash"></i></a>
                                                    </div>
                                                    <!-- View Modal -->
                                                    <div class="modal fade effect-scale modal-dark"
                                                        id="description-{{ $editor->id }}" tabindex="-1"
                                                        aria-labelledby="viewModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                                            <div class="modal-content bd-0">
                                                                <div class="modal-header pd-x-20">
                                                                    <h5 class="modal-title" id="viewModalLabel">Category
                                                                        Descripton</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body pd-20">
                                                                    <p class="mg-b-5">
                                                                        @if (!$editor->description)
                                                                            No Description Added
                                                                        @else
                                                                            {!! $editor->description !!}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade effect-scale modal-dark"
                                                        id="softdelete-{{ $editor->id }}" tabindex="-1"
                                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                                            <div class="modal-content bd-0">
                                                                <div class="modal-header pd-x-20">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Delete
                                                                        Category</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body pd-20">
                                                                    <p class="mg-b-5">
                                                                        Are You Sure You Want To Delete This Category
                                                                        Permanently!
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                        data-dismiss="modal">Close</button>
                                                                    <form
                                                                        action="{{ route('editor.destroy', $editor->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit" name="delete"
                                                                            class="btn btn-danger btn-sm">Delete
                                                                            Category</button>
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

                        @endif
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection
