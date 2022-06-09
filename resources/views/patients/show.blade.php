@extends('layouts.app')

@section('title')
    View Patient {{ ucwords($patient->full_name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Card Information</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="pension_no" class="form-label">Card Pension Number</label>
                        <input type="text" class="form-control" id="pension_no" value="{{ $patient->relative->army_card->pension_no }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="patient_relation_id" class="form-label">Relation</label>
                        <input type="text" class="form-control" id="patient_relation_id" value="{{ ucwords($patient->relative->patient_relation->name) }}" disabled>
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
                        <input type="text" class="form-control" id="salutation" name="salutation" value="{{ ucwords($patient->salutation) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="{{ ucwords($patient->full_name) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nric" class="form-label">NRIC</label>
                        <input type="text" class="form-control" id="nric" name="nric" value="{{ ucwords($patient->nric) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ strtolower($patient->email) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="phone_no" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{ ucwords($patient->phone_no) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="gender_id" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender_id" name="gender_id" value="{{ ucwords($patient->gender->name) }}" disabled>
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
                        <input type="text" class="form-control" id="line_1" name="line_1" value="{{ ucwords($patient->address->line_1) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="line_2" class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" id="line_2" name="line_2" value="{{ ucwords($patient->address->line_2) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="line_3" class="form-label">Address Line 3</label>
                        <input type="text" class="form-control" id="line_3" name="line_3" value="{{ ucwords($patient->address->line_3) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{ ucwords($patient->address->postcode) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ ucwords($patient->address->city) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="state_id" class="form-label">State</label>
                        <input type="text" class="form-control" id="state_id" name="state_id" value="{{ ucwords($patient->address->state->name) }}" disabled>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('armyCards.show', ['armyCard'=>$patient->relative->army_card->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <div class="d-flex gap-1">
                        <a href="{{ route('armyCards.patients.edit', ['armyCard'=>$patient->relative->army_card->id, 'patient'=>$patient->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-patient"><i class="fas fa-trash"></i> Delete</button>

                        <div class="modal fade" id="modal-delete-patient">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Are you sure?</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-text">Are you sure to delete patient {{ $patient->full_name }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('armyCards.patients.destroy', ['armyCard'=>$patient->relative->army_card->id, 'patient'=>$patient->id]) }}" method="post">
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