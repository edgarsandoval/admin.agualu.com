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

use App\Helpers\Response;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::where('id', '<>', Auth::user()->id)->with('city')->get();

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

        return view('users.create', compact('states', 'cities', 'ranges', 'status', 'users'));
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
                         ->with('success_message', 'User successfully added.');
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

        return view('users.show', [
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
                         ->with('success_message', 'User successfully edited.');
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

        return response()->json(Response::set(true, 'Usuario eliminado correctamente'));
    }

    public function profile() {
        $user = Auth::user();

        return view('users.show', [
            'user' => $user
        ]);
    }

    public function budget() {
        return view('users.budget');
    }

    public function network() {
        $network = [];
        $machinesId = [];

        $queue = new \SplQueue();

        $user = Auth::user();
        $user->parentId = null;
        $user->level    = 1;

        foreach ($user->childrens as $children) {
            $children->level = 2;
            $queue->push($children);
        }

        $network[] = $this->_parseOrgChartNodeModel($user);

    	while(!$queue->isEmpty()) {
            $node = $queue->pop();

            if($node->level == 8)
                continue;

            if($node instanceof User) {
                $father = $node->father;

                if(!$father instanceof User)
                    $node->user_id =  $father->id . 'M';
            }
            else
                $machinesId[] = $node->id . 'M';

            if(count($node->childrens) != 0) {
                foreach ($node->childrens as $children) {
                    $children->level = $node->level + 1;
                    $queue->push($children);
                }
            }

            $network[] = $this->_parseOrgChartNodeModel($node);
        }

        return view('users.network', compact('network', 'machinesId'));
    }

    public function directory() {
        $users = [];

        $queue = new \SplQueue();

        $user = Auth::user();
        $user->level    = 1;

        foreach ($user->childrens as $children) {
            $children->level = 2;
            $queue->push($children);
        }


    	while(!$queue->isEmpty()) {
            $node = $queue->pop();

            if($node->level == 8)
                continue;

            if(count($node->childrens) != 0) {
                foreach ($node->childrens as $children) {
                    $children->level = $node->level + 1;
                    $queue->push($children);
                }
            }

            if($node instanceof User)
                $users[] = $node;
        }

        return view('users.index', compact('users'));
    }

    private function _parseOrgChartNodeModel($node) {
        if($node instanceof User) {
            return [
                'id'                => $node->id,
                'parentId'          => $node->user_id,
                'name'              => $node->full_name,
                'distributorNumber' => 'Distribuidor ' . $node->member_code,
                'level'             => 'Nivel '. $node->level,
                'state'             => (isset($node->city) ? $node->city->name . ', ' : ''). $node->state->name,
                'consumption'       => 'Consumo $' . number_format(0, 2),
            ];
        }
        else {
            return [
                'id'                => $node->id . 'M',
                'parentId'          => $node->user_id,
                'name'              => 'Máquina #' . $node->id,
                'level'             => 'Nivel ' . $node->level,
                'state'             => $node->state->name,
                // 'CompraPersonal'    => 'xd',
            ];
        }
    }
}
