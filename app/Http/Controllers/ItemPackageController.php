<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPackage;
use Illuminate\Http\Request;

class ItemPackageController extends Controller
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
        $item_package = new ItemPackage;
        $item_package->quantity = $request->quantity;
        $item_package->external_uom_id = $request->external_uom_id;
        $item_package->internal_uom_id = $request->internal_uom_id;
        $item_package->item_id = $item->id;
        $item_package->save();

        return;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @param  \App\Models\ItemPackage  $itemPackage
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, ItemPackage $itemPackage)
    {
        $itemPackage->quantity = $request->quantity;
        $itemPackage->external_uom_id = $request->external_uom_id;
        $itemPackage->internal_uom_id = $request->internal_uom_id;
        $itemPackage->item_id = $request->item_id;
        $itemPackage->save();

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemPackage  $itemPackage
     * @return \Illuminate\Http\Response
     */
    public static function destroy(ItemPackage $itemPackage)
    {
        $itemPackage->delete();

        return;
    }
}
