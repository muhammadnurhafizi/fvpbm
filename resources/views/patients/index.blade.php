@extends('layouts.app')

@section('title')
    Patients
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('patients.index') }}" method="get">
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
                                    <th>Full Name</th>
                                    <th>Identification Number</th>
                                    <th>Pension Number</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (sizeOf($patients))
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('armyCards.patients.show', ["armyCard"=>$patient->relative->army_card, "patient"=>$patient]) }}" class="text-decoration-none">{{ ucwords($patient->full_name) }}</a></td>
                                            <td>{{ $patient->nric }}</td>
                                            <td><a href="{{ route('armyCards.show', ['armyCard'=>$patient->relative->army_card]) }}" class="text-decoration-none">{{ $patient->relative->army_card->pension_no }}</a></td>
                                            <td>{{ strtolower($patient->email) }}</td>
                                            <td>{{ strtolower($patient->phone_no) }}</td>
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
                            {!! $patients->links() !!}
                        </div>
                    </div>
                </div>
                {{-- <div class="card-footer">
                    <a href="{{ route('pa.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Create a new clinic</a>
                </div> --}}
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection