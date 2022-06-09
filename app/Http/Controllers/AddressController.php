<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        $address = new Address;
        $address->line_1 = strtolower($request->line_1);
        $address->line_2 = strtolower($request->line_2);
        $address->line_3 = strtolower($request->line_3);
        $address->postcode = $request->postcode;
        $address->city = strtolower($request->city);
        $address->state_id = $request->state_id;
        $address->save();

        return $address->id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, Address $address)
    {
        $address->line_1 = strtolower($request->line_1);
        $address->line_2 = strtolower($request->line_2);
        $address->line_3 = strtolower($request->line_3);
        $address->postcode = $request->postcode;
        $address->city = strtolower($request->city);
        $address->state_id = $request->state_id;
        $address->update();

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public static function destroy(Address $address)
    {
        $address->delete();

        return;
    }
}
