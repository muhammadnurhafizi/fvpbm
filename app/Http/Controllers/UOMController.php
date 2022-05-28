<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use Illuminate\Http\Request;

class UOMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $uOMs = UOM::where([
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

        return view('uOMs.index', compact('keyword', 'uOMs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uOMs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uOM = new UOM;
        $uOM->name = $request->name;
        $uOM->description = $request->description;
        $uOM->save();

        return redirect()->route('uOMs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function show(UOM $uOM)
    {
        return view('uOMs.show', compact('uOM'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function edit(UOM $uOM)
    {
        return view('uOMs.edit', compact('uOM'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UOM $uOM)
    {
        $uOM->name = $request->name;
        $uOM->description = $request->description;
        $uOM->update();

        return redirect()->route('uOMs.show', compact('uOM'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UOM  $uOM
     * @return \Illuminate\Http\Response
     */
    public function destroy(UOM $uOM)
    {
        $uOM->delete();

        return redirect()->route('uOMs.index');
    }
}
