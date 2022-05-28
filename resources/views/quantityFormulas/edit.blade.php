@extends('layouts.app')

@section('title')
    Edit Quantity Formula {{ ucwords($quantityFormula->name) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('quantityFormulas.update', ["quantityFormula"=>$quantityFormula->id]) }}" method="post">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Quantity Formula Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $quantityFormula->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $quantityFormula->description }}">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" id="toggle_quantity" name="toggle_quantity" class="form-check-input" @if ($quantityFormula->default_quantity) checked @endif>
                            <label for="toggle_quantity" class="form-check-label">Has default value</label>
                        </div>
                        <div class="mb-3 @if ($quantityFormula->pieces_quantity) d-none @endif">
                            <label for="default_quantity" class="form-label">Default Quantity</label>
                            <input type="number" class="form-control" id="default_quantity" name="default_quantity" value="{{ $quantityFormula->default_quantity }}">
                        </div>
                        <div class="mb-3 @if ($quantityFormula->default_quantity) d-none @endif">
                            <label for="pieces_quantity" class="form-label">Pieces Quantity</label>
                            <input type="number" class="form-control" id="pieces_quantity" name="pieces_quantity" value="{{ $quantityFormula->pieces_quantity }}">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('quantityFormulas.show', ["quantityFormula"=>$quantityFormula->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#toggle_quantity').change(function() {
            if (this.checked) {
                $('#default_quantity').parent().removeClass('d-none');
                $('#pieces_quantity').parent().addClass('d-none');

                $('#default_quantity').val('');
            } else {
                $('#default_quantity').parent().addClass('d-none');
                $('#pieces_quantity').parent().removeClass('d-none');

                $('#pieces_quantity').val('');
            }
        })
    </script>
@endsection