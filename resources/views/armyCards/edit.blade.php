@extends('layouts.app')

@section('title')
    Edit Army Card {{ ucwords($armyCard->pension_no) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('armyCards.update', ["armyCard"=>$armyCard->id]) }}" method="post">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="pension_no" class="form-label">Pension Number</label>
                            <input type="text" class="form-control" id="pension_no" name="pension_no" value="{{ $armyCard->pension_no }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="veteran_status_id" class="form-label">Veteran Status</label>
                            <select name="veteran_status_id" id="veteran_status_id" class="form-select" required>
                                <option value="" disabled selected>-- Select --</option>
                                @foreach ($veteranStatuses as $veteranStatus)
                                    <option value="{{ $veteranStatus->id }}" @if ($armyCard->veteran_status_id == $veteranStatus->id) selected @endif>{{ ucwords($veteranStatus->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="agency_id" class="form-label">Agency</label>
                            <select name="agency_id" id="agency_id" class="form-select" required>
                                <option value="" disabled selected>-- Select --</option>
                                @foreach ($agencies as $agency)
                                    <option value="{{ $agency->id }}" @if ($armyCard->agency_id == $agency->id) selected @endif>{{ ucwords($agency->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="army_type_id" class="form-label">Army Type</label>
                            <select name="army_type_id" id="army_type_id" class="form-select" required>
                                <option value="" disabled selected>-- Select --</option>
                                @foreach ($armyTypes as $armyType)
                                    <option value="{{ $armyType->id }}" @if ($armyCard->army_type_id == $armyType->id) selected @endif>{{ ucwords($armyType->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('armyCards.show', ["armyCard"=>$armyCard->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection