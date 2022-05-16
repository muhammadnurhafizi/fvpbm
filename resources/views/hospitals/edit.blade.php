@extends('layouts.app')

@section('title')
    Edit Hospital {{ ucwords($hospital->name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('hospitals.update', ["hospital"=>$hospital->id]) }}" method="post">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Hospital Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $hospital->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $hospital->description }}">
                        </div>
                            
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('hospitals.show', ["hospital"=>$hospital->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection