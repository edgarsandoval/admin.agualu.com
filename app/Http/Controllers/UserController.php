<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\State;
use App\Range;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class UserController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::with('city')->get();

        return view('users.index', compact('users'));
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
        $roles = Role::get();

        return view('user.create', compact('states', 'cities', 'ranges', 'status', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // TODO validate
        $user = User::create($request->all());
        $user->member_code = $user->state->acronym . '-' . str_pad(count(State::find($user->state->id)->users), 4, "0", STR_PAD_LEFT);
        $user->save();

        $roles = $request->input('roles');

        if(isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }

        return redirect()->route('users')
                         ->with('flash_message', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('users');
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
        $user   = User::findOrFail($id);
        $cities = State::find($user->state_id)->cities->pluck('name','id');
        $roles = Role::get();

        return view('users.edit',  compact('states', 'cities', 'ranges', 'status', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        // TODO validate
        $input = $request->except(['_method', '_token', '___', 'confirmpassword', 'gender']);
        $user->fill($input)->save();

        $roles = $request->input('roles');

        if(isset($roles))
            $user->roles()->sync($roles);
        else
             $user->roles()->detach();

        return redirect()->route('users')
                         ->with('flash_message', 'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')
                         ->with('flash_message', 'User successfully deleted.');
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
