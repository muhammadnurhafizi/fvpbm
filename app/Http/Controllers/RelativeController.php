<?php

namespace App\Http\Controllers;

use App\Models\Relative;
use Illuminate\Http\Request;

class RelativeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request, $patient_id)
    {
        $relative = new Relative;
        $relative->army_card_id = $request->army_card_id;
        $relative->patient_relation_id = $request->patient_relation_id;
        $relative->patient_id = $patient_id;
        $relative->save();

        return;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relative  $relative
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, Relative $relative)
    {
        $relative->army_card_id = $request->army_card_id;
        $relative->patient_relation_id = $request->patient_relation_id;
        $relative->patient_id = $request->patient_id;
        $relative->update();

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relative  $relative
     * @return \Illuminate\Http\Response
     */
    public static function destroy(Relative $relative)
    {
        $relative->delete();

        return;
    }
}
