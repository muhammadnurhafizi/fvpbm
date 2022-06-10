<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $instructions = Instruction::where([
            [function ($query) use ($request) {
                if (($term = $request->keyword)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('name')
            ->paginate(15);

        return view('instructions.index', compact('keyword', 'instructions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instruction = new Instruction;
        $instruction->name = strtolower($request->name);
        $instruction->save();

        return redirect()->route('instructions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function show(Instruction $instruction)
    {
        return view('instructions.show', compact('instruction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function edit(Instruction $instruction)
    {
        return view('instructions.edit', compact('instruction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instruction $instruction)
    {
        $instruction->name = strtolower($request->name);
        $instruction->update();

        return redirect()->route('instructions.show', compact('instruction'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruction $instruction)
    {
        $instruction->delete();

        return redirect()->route('instructions.index');
    }
}
