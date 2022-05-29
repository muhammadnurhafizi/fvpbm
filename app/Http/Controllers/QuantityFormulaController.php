<?php

namespace App\Http\Controllers;

use App\Models\QuantityFormula;
use Illuminate\Http\Request;

class QuantityFormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $quantityFormulas = QuantityFormula::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('description', 'LIKE', '%' . $term . '%')
                        ->orWhere('default_quantity', 'LIKE', '%' . $term . '%')
                        ->orWhere('dose_quantity', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('name')
            ->paginate(15);

        return view('quantityFormulas.index', compact('keyword', 'quantityFormulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quantityFormulas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quantityFormula = new QuantityFormula;
        $quantityFormula->name = $request->name;
        $quantityFormula->description = strtolower($request->description);
        
        if ($request->toggle_quantity) {
            $quantityFormula->default_quantity = $request->default_quantity;
            $quantityFormula->pieces_quantity = null;
        } else {
            $quantityFormula->default_quantity = null;
            $quantityFormula->pieces_quantity = $request->pieces_quantity;
        }

        $quantityFormula->save();

        return redirect()->route('quantityFormulas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuantityFormula  $quantityFormula
     * @return \Illuminate\Http\Response
     */
    public function show(QuantityFormula $quantityFormula)
    {
        return view('quantityFormulas.show', compact('quantityFormula'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuantityFormula  $quantityFormula
     * @return \Illuminate\Http\Response
     */
    public function edit(QuantityFormula $quantityFormula)
    {
        return view('quantityFormulas.edit', compact('quantityFormula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuantityFormula  $quantityFormula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuantityFormula $quantityFormula)
    {
        $quantityFormula->name = $request->name;
        $quantityFormula->description = strtolower($request->description);
        
        if ($request->toggle_quantity) {
            $quantityFormula->default_quantity = $request->default_quantity;
            $quantityFormula->pieces_quantity = null;
        } else {
            $quantityFormula->default_quantity = null;
            $quantityFormula->pieces_quantity = $request->pieces_quantity;
        }

        $quantityFormula->save();

        return redirect()->route('quantityFormulas.show', compact('quantityFormula'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuantityFormula  $quantityFormula
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuantityFormula $quantityFormula)
    {
        $quantityFormula->delete();

        return redirect()->route('quantityFormulas.index');
    }
}
