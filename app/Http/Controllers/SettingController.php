<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Setting;

class SettingController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sections = [
            [
                'name' => 'Inscripción',
                'fields' => [
                    [
                        'name'  => 'registration_fee',
                        'value' => '',
                        'label' => 'Cuota de inscripción'

                    ]
                ]
            ],
            [
                'name' => 'Repartición de niveles',
                'fields' => [
                    [
                        'name'  => 'owner_percentage',
                        'value' => '',
                        'label' => 'Porcentaje para el dueño de la máquina'
                    ]
                ]
            ]
        ];

        for($i = 1; $i <= 7; $i++)
            $sections[1]['fields'][] = [
                'name'  => 'level_' . $i . '_percentage',
                'value' => '',
                'label' => 'Porcentaje para nivel no. ' . $i
            ];

        $sections = json_decode(json_encode($sections));

        foreach($sections as $section)
            foreach($section->fields as &$field)
                $field->value = Setting::get($field->name, '');



        return view('settings.index', compact('sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        foreach ($request->except(['_method', '_token']) as $name => $value) {
            Setting::set($name, $value);
        }

        return redirect()->route('parameters');
    }

}
