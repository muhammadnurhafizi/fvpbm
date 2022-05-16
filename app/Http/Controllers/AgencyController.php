<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $agencies = Agency::where([
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

        return view('agencies.index', compact('keyword', 'agencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agency = new Agency;
        $agency->name = $request->name;
        $agency->description = strtolower($request->description);
        $agency->save();

        return redirect()->route('agencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        return view('agencies.show', compact('agency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        return view('agencies.edit', compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency)
    {
        $agency->name = $request->name;
        $agency->description = strtolower($request->description);
        $agency->update();

        return redirect()->route('agencies.show', compact('agency'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();

        return redirect()->route('agencies.index');
    }
}
