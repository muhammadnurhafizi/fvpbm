<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\ArmyCard;
use App\Models\ArmyType;
use App\Models\VeteranStatus;
use Illuminate\Http\Request;

class ArmyCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $armyCards = ArmyCard::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('pension_no', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('pension_no')
            ->paginate(15);

        return view('armyCards.index', compact('keyword', 'armyCards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $veteranStatuses = VeteranStatus::orderBy('name')->get();
        $agencies = Agency::orderBy('name')->get();
        $armyTypes = ArmyType::orderBy('name')->get();

        return view('armyCards.create', compact('veteranStatuses', 'agencies', 'armyTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = ArmyCard::where('pension_no', $request->pension_no)->first();
        if ($exist != null) {
            return redirect()->back();
        }

        $armyCard = new ArmyCard;
        $armyCard->pension_no = $request->pension_no;
        $armyCard->veteran_status_id = $request->veteran_status_id;
        $armyCard->agency_id = $request->agency_id;
        $armyCard->army_type_id = $request->army_type_id;
        $armyCard->save();

        return redirect()->route('armyCards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArmyCard  $armyCard
     * @return \Illuminate\Http\Response
     */
    public function show(ArmyCard $armyCard)
    {
        return view('armyCards.show', compact('armyCard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArmyCard  $armyCard
     * @return \Illuminate\Http\Response
     */
    public function edit(ArmyCard $armyCard)
    {
        $veteranStatuses = VeteranStatus::orderBy('name')->get();
        $agencies = Agency::orderBy('name')->get();
        $armyTypes = ArmyType::orderBy('name')->get();

        return view('armyCards.edit', compact('veteranStatuses', 'agencies', 'armyTypes', 'armyCard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArmyCard  $armyCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArmyCard $armyCard)
    {
        $exist = ArmyCard::where('pension_no', $request->pension_no)->where('id', '!=', $armyCard->id)->first();
        if ($exist != null) {
            return redirect()->back();
        }

        $armyCard->pension_no = $request->pension_no;
        $armyCard->veteran_status_id = $request->veteran_status_id;
        $armyCard->agency_id = $request->agency_id;
        $armyCard->army_type_id = $request->army_type_id;
        $armyCard->update();

        return redirect()->route('armyCards.show', compact('armyCard'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArmyCard  $armyCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArmyCard $armyCard)
    {
        $armyCard->delete();

        return redirect()->route('armyCards.index');
    }
}
