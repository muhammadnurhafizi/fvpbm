@extends('layouts.app')

@section('title')
    View Price RM {{ number_format($price->amount, 2) }}
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Address Information</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount (RM)</label>
                        <input type="text" class="form-control" id="amount" value="{{ number_format($price->amount, 2) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="price_type_id" class="form-label">Price Type</label>
                        <input type="text" class="form-control" id="price_type_id" value="{{ ucwords($price->price_type->name) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="uom_id" class="form-label">UOM</label>
                        <input type="text" class="form-control" id="uom_id" value="{{ ucwords($price->uom->name) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="started_at" class="form-label">Start Date</label>
                        <input type="text" class="form-control" id="started_at" value="{{ date_format(date_create($price->started_at), DATE_RSS) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Remarks</label>
                        <input type="text" class="form-control" id="description" value="{{ ucwords($price->description) }}" disabled>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('items.show', ['item'=>$item->id]) }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <div class="d-flex gap-1">
                        <a href="{{ route('items.prices.edit', ['item'=>$item->id, 'price'=>$price->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-price"><i class="fas fa-trash"></i> Delete</button>

                        <div class="modal fade" id="modal-delete-price">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Are you sure?</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-text">Are you sure to delete price RM {{ number_format($price->amount, 2) }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('items.prices.destroy', ['item'=>$item->id, 'price'=>$price->id]) }}" method="post">
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