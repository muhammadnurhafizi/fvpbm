@extends('layouts.app')

@section('title')
    Edit Agency {{ ucwords($agency->name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('agencies.update', ["agency"=>$agency->id]) }}" method="post">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Agency Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $agency->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $agency->description }}">
                        </div>
                            
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('agencies.show', ["agency"=>$agency->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection