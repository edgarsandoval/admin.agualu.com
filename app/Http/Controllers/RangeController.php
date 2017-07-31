<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Range;

class RangeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $toastr   = $request->session()->pull('toastr', null);
        $ranges = Range::where('id', '<>', '1')->get();

        return view('range.index', [
            'ranges' => $ranges,
            'toastr' => $toastr
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('range.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            $range = Range::create($request->all());
            if($request->ajax()) {
            }
            else {
                $request->session()->flash('toastr', ['status' => true, 'message' => 'Rango registrado exitosamente', 'class' => 'success']);
                return redirect()->route('ranges');
            }
        }
        catch(\Exception $e) {
            $request->session()->flash('toastr', ['status' => false, 'message' => 'Hubo un error en el servidor', 'class' => 'error']);
            return redirect()->route('ranges');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $range = Range::find($id);

        return view('range.edit', [
            'range' => $range
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        try {
            $range = Range::find($id);

            foreach($request->except(['_method', '_token', '___']) as $key => $value) {
                $range->{$key} = $value;
            }

            $range->save();
            $request->session()->flash('toastr', ['status' => true, 'message' => 'Rango editado exitosamente', 'class' => 'success']);
            return redirect()->route('ranges');
        }
        catch(\Exception $e) {
            $request->session()->flash('toastr', ['status' => false, 'message' => 'Hubo un error en el servidor', 'class' => 'error']);
            return redirect()->route('ranges');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Range::destroy($id);
            return response()->json([
                'status'    => true,
                'message'   => 'Rango eliminado correctamente',
                'class'     => 'success'
            ]);
        }
        catch(\Exception $e) {
            return response()->json([
                'status'    => false,
                'message'   => 'Hubo un error en el servidor',
                'class'     => 'error'
            ]);
        }
    }
}
