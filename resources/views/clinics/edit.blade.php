@extends('layouts.app')

@section('title')
    Edit Clinic {{ ucwords($clinic->name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('clinics.update', ["clinic"=>$clinic->id]) }}" method="post">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Clinic Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $clinic->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $clinic->description }}">
                        </div>
                            
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('clinics.show', ["clinic"=>$clinic->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection