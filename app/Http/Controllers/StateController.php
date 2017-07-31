<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

class StateController extends Controller {
    public function show($id) {
        $state = State::where('id', $id)->with('cities')->first();
        return response()->json(['state' => $state]);
    }
}
