@extends('layouts.app')

@section('title')
    Create a new item
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <form action="{{ route('items.store') }}" method="post">
                @csrf
                <input type="hidden" name="purchase_price_type_id" value="{{ $purchase_price_type->id }}">
                <input type="hidden" name="selling_price_type_id" value="{{ $selling_price_type->id }}">

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Item Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="item_code" class="form-label">Item Code</label>
                                    <input type="text" class="form-control" id="item_code" name="item_code" required>
                                </div>
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="generic_name" class="form-label">Generic Name</label>
                                    <input type="text" class="form-control" id="generic_name" name="generic_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="indication" class="form-label">Indication</label>
                                    <input type="text" class="form-control" id="indication" name="indication" required>
                                </div>
                                <div class="mb-3">
                                    <label for="instruction_id" class="form-label">Instruction</label>
                                    <select name="instruction_id" id="instruction_id" class="form-select" required>
                                        <option value="" disabled selected>-- Select --</option>
                                        @foreach ($instructions as $instruction)
                                            <option value="{{ $instruction->id }}">{{ ucwords($instruction->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="frequency_id" class="form-label">Frequency</label>
                                    <select name="frequency_id" id="frequency_id" class="form-select" required>
                                        <option value="" disabled selected>-- Select --</option>
                                        @foreach ($frequencies as $frequency)
                                            <option value="{{ $frequency->id }}">{{ ucwords($frequency->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity_formula_id" class="form-label">Quantity Formula</label>
                                    <select name="quantity_formula_id" id="quantity_formula_id" class="form-select" required>
                                        <option value="" disabled selected>-- Select --</option>
                                        @foreach ($quantity_formulas as $quantity_formula)
                                            <option value="{{ $quantity_formula->id }}">{{ ucwords($quantity_formula->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Item Packaging Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="external_uom_id" class="form-label">External UOM</label>
                                    <select name="external_uom_id" id="external_uom_id" class="form-select" required>
                                        <option value="" disabled selected>-- Select --</option>
                                        @foreach ($uOMs as $uom)
                                            <option value="{{ $uom->id }}">{{ ucwords($uom->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity Per Packaging</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" required>
                                </div>
                                <div class="mb-3">
                                    <label for="internal_uom_id" class="form-label">Internal UOM</label>
                                    <select name="internal_uom_id" id="internal_uom_id" class="form-select" required>
                                        <option value="" disabled selected>-- Select --</option>
                                        @foreach ($uOMs as $uom)
                                            <option value="{{ $uom->id }}">{{ ucwords($uom->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Stock Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="stock_level" class="form-label">Stock Level</label>
                                    <input type="text" class="form-control" id="stock_level" name="stock_level" required>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    
@endsection