<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use Illuminate\Http\Request;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $frequencies = Frequency::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('description', 'LIKE', '%' . $term . '%')
                        ->orWhere('value', '=', $term)
                        ->get();
                }
            }]
        ])
            ->orderBy('name')
            ->paginate(15);

        return view('frequencies.index', compact('keyword', 'frequencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frequencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $frequency = new Frequency;
        $frequency->name = $request->name;
        $frequency->description = strtolower($request->description);
        $frequency->value = $request->value;
        $frequency->save();

        return redirect()->route('frequencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frequency  $frequency
     * @return \Illuminate\Http\Response
     */
    public function show(Frequency $frequency)
    {
        return view('frequencies.show', compact('frequency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frequency  $frequency
     * @return \Illuminate\Http\Response
     */
    public function edit(Frequency $frequency)
    {
        return view('frequencies.edit', compact('frequency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frequency  $frequency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frequency $frequency)
    {
        $frequency->name = $request->name;
        $frequency->description = strtolower($request->description);
        $frequency->value = $request->value;
        $frequency->save();

        return redirect()->route('frequencies.show', compact('frequency'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frequency  $frequency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frequency $frequency)
    {
        $frequency->delete();

        return redirect()->route('frequencies.index');
    }
}
