<?php

namespace App\Http\Controllers;

use App\Models\PatientRelation;
use Illuminate\Http\Request;

class PatientRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $patientRelations = PatientRelation::where([
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

        return view('patientRelations.index', compact('keyword', 'patientRelations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patientRelations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patientRelation = new PatientRelation;
        $patientRelation->name = $request->name;
        $patientRelation->description = strtolower($request->description);
        $patientRelation->save();

        return redirect()->route('patientRelations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientRelation  $patientRelation
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRelation $patientRelation)
    {
        return view('patientRelations.show', compact('patientRelation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientRelation  $patientRelation
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRelation $patientRelation)
    {
        return view('patientRelations.edit', compact('patientRelation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientRelation  $patientRelation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRelation $patientRelation)
    {
        $patientRelation->name = $request->name;
        $patientRelation->description = strtolower($request->description);
        $patientRelation->update();

        return redirect()->route('patientRelations.show', compact('patientRelation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientRelation  $patientRelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRelation $patientRelation)
    {
        $patientRelation->delete();

        return redirect()->route('patientRelations.index');
    }
}
