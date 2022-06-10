<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $priceTypes = PriceType::where([
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

        return view('priceTypes.index', compact('keyword', 'priceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('priceTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $priceType = new PriceType;
        $priceType->name = $request->name;
        $priceType->description = strtolower($request->description);
        $priceType->save();

        return redirect()->route('priceTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function show(PriceType $priceType)
    {
        return view('priceTypes.show', compact('priceType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceType $priceType)
    {
        return view('priceTypes.edit', compact('priceType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceType $priceType)
    {
        $priceType->name = $request->name;
        $priceType->description = strtolower($request->description);
        $priceType->save();

        return redirect()->route('priceTypes.show', compact('priceType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceType $priceType)
    {
        $priceType->delete();

        return redirect()->route('priceTypes.index');
    }
}
