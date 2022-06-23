<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use App\Models\Instruction;
use App\Models\Item;
use App\Models\PriceType;
use App\Models\QuantityFormula;
use App\Models\UOM;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $items = Item::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('item_code', 'LIKE', '%' . $term . '%')
                        ->orWhere('brand_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('generic_name', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('item_code')
            ->paginate(15);

        return view('items.index', compact('keyword', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructions = Instruction::orderBy('name')->get();
        $frequencies = Frequency::orderBy('name')->get();
        $quantity_formulas = QuantityFormula::orderBy('name')->get();
        $uOMs = UOM::orderBy('name')->get();
        $purchase_price_type = PriceType::where('name', 'like', '%purchase%')->first();
        $selling_price_type = PriceType::where('name', 'like', '%sale%')->first();

        return view('items.create', compact('instructions', 'frequencies', 'quantity_formulas', 'uOMs', 'purchase_price_type', 'selling_price_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item;
        $item->item_code = strtolower($request->item_code);
        $item->brand_name = strtolower($request->brand_name);
        $item->generic_name = strtolower($request->generic_name);
        $item->indication = strtolower($request->indication);
        $item->instruction_id = $request->instruction_id;
        $item->frequency_id = $request->frequency_id;
        $item->quantity_formula_id = $request->quantity_formula_id;
        $item->save();

        ItemPackageController::store($request, $item);
        StockController::store($request, $item);

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $instructions = Instruction::orderBy('name')->get();
        $frequencies = Frequency::orderBy('name')->get();
        $quantity_formulas = QuantityFormula::orderBy('name')->get();
        $uOMs = UOM::orderBy('name')->get();
        $purchase_price_type = PriceType::where('name', 'like', '%purchase%')->first();
        $selling_price_type = PriceType::where('name', 'like', '%sale%')->first();

        return view('items.edit', compact('instructions', 'frequencies', 'quantity_formulas', 'uOMs', 'purchase_price_type', 'selling_price_type', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->item_code = strtolower($request->item_code);
        $item->brand_name = strtolower($request->brand_name);
        $item->generic_name = strtolower($request->generic_name);
        $item->indication = strtolower($request->indication);
        $item->instruction_id = $request->instruction_id;
        $item->frequency_id = $request->frequency_id;
        $item->quantity_formula_id = $request->quantity_formula_id;
        $item->save();

        ItemPackageController::update($request, $item->item_package);
        StockController::update($request, $item->stock);

        return redirect()->route('items.show', compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        ItemPackageController::destroy($item->item_package);
        StockController::destroy($item->stock);
        $item->delete();

        return redirect()->route('items.index');
    }
}
