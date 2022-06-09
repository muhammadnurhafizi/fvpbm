<?php

namespace App\Http\Controllers;

use App\Models\ArmyCard;
use App\Models\Gender;
use App\Models\Patient;
use App\Models\PatientRelation;
use App\Models\State;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $patients = Patient::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('salutation', 'LIKE', '%' . $term . '%')
                        ->orWhere('full_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('nric', 'LIKE', '%' . $term . '%')
                        ->orWhere('email', 'LIKE', '%' . $term . '%')
                        ->orWhere('phone_no', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('full_name')
            ->paginate(15);

        return view('patients.index', compact('keyword', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\ArmyCard  $armyCard
     * @return \Illuminate\Http\Response
     */
    public function create(ArmyCard $armyCard, Request $request)
    {
        $genders = Gender::orderBy('name')->get();
        $states = State::orderBy('name')->get();

        if (isset($request->relative))
            $patient_relations = PatientRelation::where('name', 'NOT LIKE', '%owner%')->orderBy('name')->get();
        else
            $patient_relations = PatientRelation::where('name', 'LIKE', '%owner%')->orderBy('name')->get();
            
        return view('patients.create', compact('armyCard', 'genders', 'states', 'patient_relations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArmyCard  $armyCard
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ArmyCard $armyCard)
    {
        $address_id = AddressController::store($request);

        $patient = new Patient;
        $patient->salutation = strtolower($request->salutation);
        $patient->full_name = strtolower($request->full_name);
        $patient->nric = $request->nric;
        $patient->email = strtolower($request->email);
        $patient->phone_no = strtolower($request->phone_no);
        $patient->gender_id = $request->gender_id;
        $patient->address_id = $address_id;
        $patient->save();

        RelativeController::store($request, $patient->id);

        return redirect()->route('armyCards.show', ["armyCard"=>$armyCard]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArmyCard  $armyCard
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(ArmyCard $armyCard, Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArmyCard  $armyCard
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(ArmyCard $armyCard, Patient $patient, Request $request)
    {
        $genders = Gender::orderBy('name')->get();
        $states = State::orderBy('name')->get();

        if (strcmp($patient->relative->patient_relation->name, 'owner'))
            $patient_relations = PatientRelation::where('name', 'NOT LIKE', '%owner%')->orderBy('name')->get();
        else
            $patient_relations = PatientRelation::where('name', 'LIKE', '%owner%')->orderBy('name')->get();

        return view('patients.edit', compact('patient', 'armyCard', 'genders', 'states', 'patient_relations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArmyCard  $armyCard
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArmyCard $armyCard, Patient $patient)
    {
        AddressController::update($request, $patient->address);

        $patient->salutation = strtolower($request->salutation);
        $patient->full_name = strtolower($request->full_name);
        $patient->nric = $request->nric;
        $patient->email = strtolower($request->email);
        $patient->phone_no = strtolower($request->phone_no);
        $patient->gender_id = $request->gender_id;
        $patient->address_id = $request->address_id;
        $patient->update();

        RelativeController::update($request, $patient->relative);

        return redirect()->route('armyCards.patients.show', compact('armyCard', 'patient'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArmyCard  $armyCard
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArmyCard $armyCard, Patient $patient)
    {
        RelativeController::destroy($patient->relative);

        $patient->delete();
        
        AddressController::destroy($patient->address);

        return redirect()->route('armyCards.show', compact('armyCard'));
    }

}
