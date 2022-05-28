<?php

namespace App\Http\Controllers;

use App\Models\ArmyType;
use Illuminate\Http\Request;

class ArmyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $armyTypes = ArmyType::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('description', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('name')
            ->paginate(15);

        return view('armyTypes.index', compact('keyword', 'armyTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('armyTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $armyType = new ArmyType;
        $armyType->name = strtolower($request->name);
        $armyType->description = strtolower($request->description);
        $armyType->save();

        return redirect()->route('armyTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArmyType  $armyType
     * @return \Illuminate\Http\Response
     */
    public function show(ArmyType $armyType)
    {
        return view('armyTypes.show', compact('armyType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArmyType  $armyType
     * @return \Illuminate\Http\Response
     */
    public function edit(ArmyType $armyType)
    {
        return view('armyTypes.edit', compact('armyType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArmyType  $armyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArmyType $armyType)
    {
        $armyType->name = strtolower($request->name);
        $armyType->description = strtolower($request->description);
        $armyType->save();

        return redirect()->route('armyTypes.show', compact('armyType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArmyType  $armyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArmyType $armyType)
    {
        $armyType->delete();

        return redirect()->route('armyTypes.index');
    }
}
