@extends('layouts.app')

@section('title')
    View Army Card {{ ucwords($armyCard->pension_no) }}
@endsection

@section('content')
    
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Pension Number</label>
                        <input type="text" class="form-control" value="{{ ucwords($armyCard->pension_no) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="veteran_status_id" class="form-label">Veteran Status</label>
                        <input type="text" class="form-control" value="{{ ucwords($armyCard->veteran_status->name) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="agency_id" class="form-label">Agency</label>
                        <input type="text" class="form-control" value="{{ ucwords($armyCard->agency->name) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="army_type_id" class="form-label">Army Type</label>
                        <input type="text" class="form-control" value="{{ ucwords($armyCard->army_type->name) }}" disabled>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('armyCards.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <div class="d-flex gap-1">
                        <a href="{{ route('armyCards.edit', ["armyCard"=>$armyCard->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-armyCard"><i class="fas fa-trash"></i> Delete</button>

                        <div class="modal fade" id="modal-delete-armyCard">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Are you sure?</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-text">Are you sure to delete army card {{ $armyCard->pension_no }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('armyCards.destroy', ["armyCard"=>$armyCard->id]) }}" method="post">
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

    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Card Owner</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>NRIC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 0;
                                @endphp

                                @if (sizeOf($armyCard->relatives))
                                    @foreach ($armyCard->relatives as $relative)
                                        @if ($relative->patient_relation_id == 1)
                                            @php
                                                $cardOwner = $relative->patient;
                                            @endphp

                                            <tr>
                                                <td>{{ ++$num }}</td>
                                                <td><a href="{{ route('armyCards.patients.show', ["armyCard"=>$armyCard->id, "patient"=>$cardOwner->id]) }}">{{ ucwords($cardOwner->full_name) }}</a></td>
                                                <td>{{ $cardOwner->nric }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if ($num == 0)
                                        <tr>
                                            <td colspan="3" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($num == 0)
                    <div class="card-footer">
                        <a href="{{ route('armyCards.patients.create', ['armyCard'=>$armyCard->id]) }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Add Card Owner</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Relatives</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>NRIC</th>
                                    <th>Relation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 0;
                                @endphp

                                @if (sizeOf($armyCard->relatives))
                                    @foreach ($armyCard->relatives as $relative)
                                        @if ($relative->patient_relation_id !== 1)
                                            <tr>
                                                <td>{{ ++$num }}</td>
                                                <td><a href="{{ route('armyCards.patients.show', ["armyCard"=>$armyCard->id, "patient"=>$relative->patient->id]) }}">{{ ucwords($relative->patient->full_name) }}</a></td>
                                                <td>{{ $relative->patient->nric }}</td>
                                                <td>{{ ucwords($relative->patient_relation->name) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if ($num == 0)
                                        <tr>
                                            <td colspan="4" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('armyCards.patients.create', ['armyCard'=>$armyCard->id, 'relative'=>1]) }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Add Relative</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection