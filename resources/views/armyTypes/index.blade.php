@extends('layouts.app')

@section('title')
    Army Types
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('armyTypes.index') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Search..." value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
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
                                @if (sizeOf($armyTypes))
                                    @foreach ($armyTypes as $armyType)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('armyTypes.show', ["armyType"=>$armyType->id]) }}" class="text-decoration-none">{{ ucwords($armyType->name) }}</a></td>
                                            <td>{{ ucwords($armyType->description) }}</td>
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
                            {!! $armyTypes->links() !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('armyTypes.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Create a new army type</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection