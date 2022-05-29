@extends('layouts.app')

@section('title')
    Army Cards
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('armyCards.index') }}" method="get">
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
                                    <th>Pension Number</th>
                                    <th>Veteran Status</th>
                                    <th>Agency</th>
                                    <th>Army Type</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (sizeOf($armyCards))
                                    @foreach ($armyCards as $armyCard)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('armyCards.show', ["armyCard"=>$armyCard->id]) }}" class="text-decoration-none">{{ ucwords($armyCard->pension_no) }}</a></td>
                                            <td>{{ ucwords($armyCard->veteran_status->name) }}</td>
                                            <td>{{ ucwords($armyCard->agency->name) }}</td>
                                            <td>{{ ucwords($armyCard->army_type->name) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $armyCards->links() !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('armyCards.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Create a new army card</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection