@extends('layouts.app')

@section('title')
    Roles
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (sizeOf($roles))
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('roles.show', ["role"=>$role->id]) }}" class="text-decoration-none">{{ ucwords($role->name) }}</a></td>
                                            <td>{{ ucwords($role->description) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Create a new role</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection