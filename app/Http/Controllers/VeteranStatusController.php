<?php

namespace App\Http\Controllers;

use App\Models\VeteranStatus;
use Illuminate\Http\Request;

class VeteranStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $veteranStatuses = VeteranStatus::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('description', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderby('name')
            ->paginate(15);

        return view('veteranStatuses.index', compact('keyword', 'veteranStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veteranStatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $veteranStatus = new VeteranStatus;
        $veteranStatus->name = strtolower($request->name);
        $veteranStatus->description = strtolower($request->description);
        $veteranStatus->save();

        return redirect()->route('veteranStatuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VeteranStatus  $veteranStatus
     * @return \Illuminate\Http\Response
     */
    public function show(VeteranStatus $veteranStatus)
    {
        return view('veteranStatuses.show', compact('veteranStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VeteranStatus  $veteranStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(VeteranStatus $veteranStatus)
    {
        return view('veteranStatuses.edit', compact('veteranStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VeteranStatus  $veteranStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VeteranStatus $veteranStatus)
    {
        $veteranStatus->name = strtolower($request->name);
        $veteranStatus->description = strtolower($request->description);
        $veteranStatus->update();

        return redirect()->route('veteranStatuses.show', compact('veteranStatus'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VeteranStatus  $veteranStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(VeteranStatus $veteranStatus)
    {
        $veteranStatus->delete();

        return redirect()->route('veteranStatuses.index');
    }
}
