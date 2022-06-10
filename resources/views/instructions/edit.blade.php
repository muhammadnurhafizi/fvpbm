@extends('layouts.app')

@section('title')
    Edit Instruction {{ ucwords($instruction->name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('instructions.update', ["instruction"=>$instruction->id]) }}" method="post">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Instruction Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $instruction->name }}" required>
                        </div>                            
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('instructions.show', ["instruction"=>$instruction->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection