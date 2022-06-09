@extends('layouts.app')

@section('title')
    Edit Patient {{ ucwords($patient->full_name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('armyCards.patients.update', ["armyCard"=>$armyCard->id, "patient"=>$patient->id]) }}" method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="address_id" value="{{ $patient->address_id }}">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Card Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="pension_no" class="form-label">Card Pension Number</label>
                            <input type="text" class="form-control" id="pension_no" name="pension_no" value="{{ $armyCard->pension_no }}" disabled>
                            <input type="hidden" name="army_card_id" value="{{ $armyCard->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="patient_relation_id" class="form-label">Relation</label>
                            <select name="patient_relation_id" id="patient_relation_id" class="form-select" required>
                                <option value="" disabled selected>-- Select --</option>
                                @foreach ($patient_relations as $patient_relation)
                                    <option value="{{ $patient_relation->id }}" @if ($patient_relation->id == $patient->relative->patient_relation_id) selected @endif>{{ ucwords($patient_relation->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Patient Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="salutation" class="form-label">Salutation</label>
                            <input type="text" class="form-control" id="salutation" name="salutation" value="{{ $patient->salutation }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $patient->full_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nric" class="form-label">NRIC</label>
                            <input type="text" class="form-control" id="nric" name="nric" value="{{ $patient->nric }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $patient->email }}" >
                        </div>
                        <div class="mb-3">
                            <label for="phone_no" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{ $patient->phone_no }}" >
                        </div>
                        <div class="mb-3">
                            <label for="gender_id" class="form-label">Gender</label>
                            <select name="gender_id" id="gender_id" class="form-select">
                                <option value="">-- Select --</option>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}" @if ($gender->id == $patient->gender_id) selected @endif>{{ ucwords($gender->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Address Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="line_1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" id="line_1" name="line_1" value="{{ $patient->address->line_1 }}" >
                        </div>
                        <div class="mb-3">
                            <label for="line_2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" id="line_2" name="line_2" value="{{ $patient->address->line_2 }}" >
                        </div>
                        <div class="mb-3">
                            <label for="line_3" class="form-label">Address Line 3</label>
                            <input type="text" class="form-control" id="line_3" name="line_3" value="{{ $patient->address->line_3 }}" >
                        </div>
                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $patient->address->postcode }}" >
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $patient->address->city }}" >
                        </div>
                        <div class="mb-3">
                            <label for="state_id" class="form-label">State</label>
                            <select name="state_id" id="state_id" class="form-select">
                                <option value="">-- Select --</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" @if ($state->id == $patient->address->state_id) selected @endif>{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('armyCards.patients.show', ['armyCard'=>$armyCard->id, 'patient'=>$patient->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection