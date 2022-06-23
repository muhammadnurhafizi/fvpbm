@extends('layouts.app')

@section('title')
    View {{ ucwords($item->item_code) }}
@endsection

@section('content')
    
    <div class="row mb-3">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Item Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="item_code" class="form-label">Item Code</label>
                                <input type="text" class="form-control" id="item_code" value="{{ strtoupper($item->item_code) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="brand_name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" value="{{ strtoupper($item->brand_name) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="generic_name" class="form-label">Generic Name</label>
                                <input type="text" class="form-control" id="generic_name" value="{{ strtoupper($item->generic_name) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="indication" class="form-label">Indication</label>
                                <input type="text" class="form-control" id="indication" value="{{ strtoupper($item->indication) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="instruction_id" class="form-label">Instruction</label>
                                <input type="text" class="form-control" id="indication" value="{{ strtoupper($item->instruction->name) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="frequency_id" class="form-label">Frequency</label>
                                <input type="text" class="form-control" id="indication" value="{{ strtoupper($item->frequency->name) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="quantity_formula_id" class="form-label">Quantity Formula</label>
                                <input type="text" class="form-control" id="indication" value="{{ strtoupper($item->quantity_formula->name) }}" disabled>
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
                                <input type="text" class="form-control" id="indication" value="{{ strtoupper($item->item_package->external_uom->name) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity Per Packaging</label>
                                <input type="text" class="form-control" id="quantity" value="{{ $item->item_package->quantity }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="internal_uom_id" class="form-label">Internal UOM</label>
                                <input type="text" class="form-control" id="indication" value="{{ strtoupper($item->item_package->internal_uom->name) }}" disabled>
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
                                <input type="text" class="form-control" id="indication" value="{{ strtoupper($item->stock->stock_level) }}" disabled>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                            <div class="d-flex gap-1">
                                <a href="{{ route('items.edit', ["item"=>$item->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-item"><i class="fas fa-trash"></i> Delete</button>
        
                                <div class="modal fade" id="modal-delete-item">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Are you sure?</h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="modal-text">Are you sure to delete item {{ ucwords($item->item_code) }}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('items.destroy', ["item"=>$item->id]) }}" method="post">
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
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Purchase Price</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount (RM)</th>
                                            <th>Start Date</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (sizeOf($purchase_prices))
                                            @foreach ($purchase_prices as $price)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="{{ route('items.prices.show', ['item'=>$item->id, 'price'=>$price->id]) }}" class="text-decoration-none">RM {{ number_format($price->amount, 2) }}</a></td>
                                                    <td>{{ date_format(date_create($price->started_at), DATE_RSS) }}</td>
                                                    <td>{{ ucfirst($price->description) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer"><a href="{{ route('items.prices.create', ['item'=>$item->id, 'type'=>2]) }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Add Price</a></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Selling Price</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap align-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount (RM)</th>
                                            <th>Start Date</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (sizeOf($selling_prices))
                                            @foreach ($selling_prices as $price)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="{{ route('items.prices.show', ['item'=>$item->id, 'price'=>$price->id]) }}" class="text-decoration-none">RM {{ number_format($price->amount, 2) }}</a></td>
                                                    <td>{{ date_format(date_create($price->started_at), DATE_RSS) }}</td>
                                                    <td>{{ ucfirst($price->description) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center py-3 border-0"><span class="fw-bold text-secondary">Data not found</span></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer"><a href="{{ route('items.prices.create', ['item'=>$item->id, 'type'=>1]) }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Add Price</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection