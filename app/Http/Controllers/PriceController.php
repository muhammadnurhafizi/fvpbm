<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Price;
use App\Models\PriceType;
use App\Models\UOM;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function create(Item $item, Request $request)
    {
        $type = $request->type;

        if ($type == 1)
            $uom_id = $item->item_package->internal_uom_id;
        else if ($type == 2)
            $uom_id = $item->item_package->external_uom_id;
        else
            $uom_id = null;

        $price_types = PriceType::orderBy('name')->get();
        $uOMs = UOM::orderBy('name')->get();

        return view('prices.create', compact('item', 'type', 'uom_id', 'price_types', 'uOMs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        $latest_price = Price::where('item_id', $item->id)
            ->where('price_type_id', $request->price_type_id)
            ->orderBy('started_at', 'desc')
            ->first();

        if ($latest_price !== null && $request->started_at <= $latest_price->started_at) {
            return redirect()->back();
        }

        $price = new Price;
        $price->amount = $request->amount;
        $price->item_id = $item->id;
        $price->price_type_id = $request->price_type_id;
        $price->uom_id = $request->uom_id;
        $price->started_at = $request->started_at;
        $price->description = strtolower($request->description);
        $price->save();

        return redirect()->route('items.show', compact('item'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, Price $price)
    {
        return view('prices.show', compact('item', 'price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item, Price $price)
    {
        $price_types = PriceType::orderBy('name')->get();
        $uOMs = UOM::orderBy('name')->get();

        return view('prices.edit', compact('item', 'price', 'price_types', 'uOMs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, Price $price)
    {
        $latest_price = Price::where('item_id', $item->id)
            ->where('price_type_id', $request->price_type_id)
            ->orderBy('started_at', 'desc')
            ->first();

        if ($latest_price !== null && $request->started_at <= $latest_price->started_at) {
            return redirect()->back();
        }

        $price->amount = $request->amount;
        $price->item_id = $item->id;
        $price->price_type_id = $request->price_type_id;
        $price->uom_id = $request->uom_id;
        $price->started_at = $request->started_at;
        $price->description = strtolower($request->description);
        $price->update();

        return redirect()->route('items.prices.show', compact('item', 'price'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, Price $price)
    {
        $price->delete();

        return redirect()->route('items.show', compact('item'));
    }
}
