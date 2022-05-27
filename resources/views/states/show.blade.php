@extends('layouts.app')

@section('title')
    View State {{ ucwords($state->name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">State Name</label>
                        <input type="text" class="form-control" value="{{ ucwords($state->name) }}" disabled>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('states.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <div class="d-flex gap-1">
                        <a href="{{ route('states.edit', ["state"=>$state->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-state"><i class="fas fa-trash"></i> Delete</button>

                        <div class="modal fade" id="modal-delete-state">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Are you sure?</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-text">Are you sure to delete state {{ $state->name }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('states.destroy', ["state"=>$state->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-check"></i> Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection