<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use Illuminate\Http\Request;

class SalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $salesPersons = SalesPerson::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('name')
            ->paginate(15);

        return view('salesPersons.index', compact('keyword', 'salesPersons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salesPersons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salesPerson = new SalesPerson;
        $salesPerson->name = strtolower($request->name);
        $salesPerson->save();

        return redirect()->route('salesPersons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function show(SalesPerson $salesPerson)
    {
        return view('salesPersons.show', compact('salesPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesPerson $salesPerson)
    {
        return view('salesPersons.edit', compact('salesPerson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesPerson $salesPerson)
    {
        $salesPerson->name = strtolower($request->name);
        $salesPerson->save();

        return redirect()->route('salesPersons.show', compact('salesPerson'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesPerson $salesPerson)
    {
        $salesPerson->delete();

        return redirect()->route('salesPersons.index');
    }
}
