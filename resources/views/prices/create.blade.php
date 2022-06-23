@extends('layouts.app')

@section('title')
    Create a new price
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('items.prices.store', ["item"=>$item->id]) }}" method="post">
                @csrf
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Price Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount (RM)</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="price_type_id" class="form-label">Price Type</label>
                            <select name="price_type_id" id="price_type_id" class="form-select" required>
                                <option value="">-- Select --</option>
                                @foreach ($price_types as $price_type)
                                    <option value="{{ $price_type->id }}" @if ($price_type->id == $type) selected @endif>{{ ucwords($price_type->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="uom_id" class="form-label">UOM</label>
                            <select name="uom_id" id="uom_id" class="form-select" required>
                                <option value="">-- Select --</option>
                                @foreach ($uOMs as $uOM)
                                    <option value="{{ $uOM->id }}" @if ($uOM->id == $uom_id) selected @endif>{{ ucwords($uOM->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="started_at" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="started_at" name="started_at" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('items.show', ['item'=>$item->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection