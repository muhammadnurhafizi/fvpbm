@extends('layouts.app')

@section('title')
    Users
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (sizeOf($users))
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('users.show', ["user"=>$user->id]) }}" class="text-decoration-none">{{ ucwords($user->username) }}</a></td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ ucwords($user->role->name) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('users.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Create a new user</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection