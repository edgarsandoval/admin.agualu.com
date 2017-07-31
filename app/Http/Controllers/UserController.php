<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\State;
use App\Range;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $toastr   = $request->session()->pull('toastr', null);
        $users      = User::with('city')->get();
        return view('user.index', [
            'users' => $users,
            'toastr' => $toastr
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $states = State::pluck('name', 'id');
        $cities = State::find(1)->cities->pluck('name','id');
        $ranges = Range::pluck('name', 'id');
        $status = User::getPossibleEnumValues('status');
        $users  = User::all()->pluck('full_name', 'id');

        return view('user.create', [
            'states' => $states,
            'cities' => $cities,
            'ranges' => $ranges,
            'status' => $status,
            'users'  => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            $user = User::create($request->all());
            $user->member_code = $user->state->acronym . '-' . str_pad(count(State::find($user->state->id)->users), 4, "0", STR_PAD_LEFT);
            $user->save();
            if($request->ajax()) {
            }
            else {
                $request->session()->flash('toastr', ['status' => true, 'message' => 'Usuario registrado exitosamente', 'class' => 'success']);
                return redirect()->route('users');
            }
        }
        catch(\Exception $e) {
            $request->session()->flash('toastr', ['status' => false, 'message' => 'Hubo un error en el servidor', 'class' => 'error']);
            return redirect()->route('users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if(is_null($id) || !is_numeric($id))
            return view('404');

        $user = User::find($id);

        return view('user.show', [
            'user'  => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $states = State::pluck('name', 'id');
        $ranges = Range::pluck('name', 'id');
        $status = User::getPossibleEnumValues('status');
        $user   = User::find($id);
        $cities = State::find($user->state_id)->cities->pluck('name','id');

        return view('user.edit', [
            'states' => $states,
            'cities' => $cities,
            'ranges' => $ranges,
            'status' => $status,
            'user'   => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $user = User::find($id);

            foreach($request->except(['_method', '_token', '___', 'confirmpassword', 'gender']) as $key => $value) {
                if($key == 'password' && $value == null)
                    $user->password = $value;
                $user->{$key} = $value;
            }

            $user->save();
            $request->session()->flash('toastr', ['status' => true, 'message' => 'Usuario editadi exitosamente', 'class' => 'success']);
            return redirect()->route('users');
        }
        catch(\Exception $e) {
            $request->session()->flash('toastr', ['status' => false, 'message' => 'Hubo un error en el servidor', 'class' => 'error']);
            return redirect()->route('users');
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
            User::destroy($id);
            return response()->json([
                'status'    => true,
                'message'   => 'Usuario eliminado correctamente',
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

    public function profile() {
        $user = Auth::user();

        return view('user.show', [
            'user' => $user
        ]);
    }

    public function budget() {
        return view('user.budget');
    }
}
