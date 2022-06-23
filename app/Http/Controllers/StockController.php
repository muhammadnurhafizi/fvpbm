<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request, Item $item)
    {
        $stock = new Stock;
        $stock->stock_level = $request->stock_level;
        $stock->item_id = $item->id;
        $stock->save();

        return;
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, Stock $stock)
    {
        $stock->stock_level = $request->stock_level;
        $stock->item_id = $request->item_id;
        $stock->save();

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public static function destroy(Stock $stock)
    {
        $stock->delete();

        return;
    }
}
