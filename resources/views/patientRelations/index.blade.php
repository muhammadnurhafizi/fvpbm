@extends('layouts.app')

@section('title')
    Patient Relations
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('patientRelations.index') }}" method="get">
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
                                @if (sizeOf($patientRelations))
                                    @foreach ($patientRelations as $patientRelation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('patientRelations.show', ["patientRelation"=>$patientRelation->id]) }}" class="text-decoration-none">{{ ucwords($patientRelation->name) }}</a></td>
                                            <td>{{ ucwords($patientRelation->description) }}</td>
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
                            {!! $patientRelations->links() !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('patientRelations.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Create a new patient relation</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection