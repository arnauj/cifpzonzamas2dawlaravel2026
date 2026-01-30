<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamiliaProfesional;

class FamiliaProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familias = FamiliaProfesional::paginate(10);

        return view('familias_profesionales.index', ['familias' => $familias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = ['exito' => ''];

        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'nombre'      => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'imagen'      => 'nullable|string|max:255',
            ]);

            $familia = new FamiliaProfesional();

            $familia->nombre      = $request->input('nombre');
            $familia->descripcion = $request->input('descripcion');
            $familia->imagen      = $request->input('imagen');

            $familia->save();
            
            $data['exito'] = 'Operación realiza correctamente';
        }

        $familia = new FamiliaProfesional();

        return view('familias_profesionales.create', ['datos' => $data, 'familia' => $familia, 'disabled' => '', 'oper' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos = ['exito' => ''];
        $familia = FamiliaProfesional::find($id);

        return view('familias_profesionales.create', ['familia' => $familia, 'datos' => $datos, 'disabled' => 'disabled', 'oper' => 'show']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id = '')
    {
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'nombre'      => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'imagen'      => 'nullable|string|max:255',
            ]);

            $familia = FamiliaProfesional::find($request->input('id'));

            $familia->nombre      = $request->input('nombre');
            $familia->descripcion = $request->input('descripcion');
            $familia->imagen      = $request->input('imagen');

            $familia->save();

            $datos['exito'] = 'Operación realiza correctamente';
            $disabled = 'disabled';
        } else {
            $datos = ['exito' => ''];
            $familia = FamiliaProfesional::find($id);
            $disabled = '';
        }

        return view('familias_profesionales.create', ['familia' => $familia, 'datos' => $datos, 'disabled' => $disabled, 'oper' => 'edit']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id = '')
    {
        if ($request->isMethod('post')) {
            $familia = FamiliaProfesional::find($request->input('id'));
            $familia->delete();

            return redirect()->route('familias_profesionales.index');
        } else {
            $datos = ['exito' => ''];
            $familia = FamiliaProfesional::find($id);
            $disabled = 'disabled';

            return view('familias_profesionales.create', ['familia' => $familia, 'datos' => $datos, 'disabled' => $disabled, 'oper' => 'destroy']);
        }
    }
}