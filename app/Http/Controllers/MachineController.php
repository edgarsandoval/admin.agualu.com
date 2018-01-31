<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Machine;
use App\Report;


class MachineController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $machines = Machine::all();

        return view('machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('machines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = $request->all();
        $data['password'] = bcrypt('1234');
        $data['user_id']  = Auth::user()->id;
        $data['state_id'] = Auth::user()->state_id;

        $machine = Machine::create($data);

        return redirect()->route('machines')
                         ->with('success_message', '¡Máquina creada correctamente!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $machine   = Machine::findOrFail($id);

        return view('machines.edit',  compact('machine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $machine = Machine::find($id);
        $machine->fill($request->all());
        $machine->save();

        return redirect()->route('machines')
                         ->with('success_message', '¡Máquina editada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Machine::destroy($id);
            return response()->json([
                'status'    => true,
                'message'   => 'Máquina eliminada correctamente',
                'class'     => 'success'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status'    => false,
                'message'   => 'Hubo un error en el servidor',
                'class'     => 'error'
            ]);
        }
    }

    public function reports() {
        $machines   = Machine::all();
        $reports    = Report::all();

        return view('machines.reports', compact('machines', 'reports'));
    }
}
