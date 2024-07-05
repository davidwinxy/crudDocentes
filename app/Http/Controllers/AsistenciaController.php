<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Grupo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Asistencia::query();

    if ($request->has('fecha')) {
        $query->where('fecha', $request->fecha);
    }

    if ($request->has('estudiante_id')) {
        $query->where('estudiante_id', $request->estudiante_id);
    }

    if ($request->has('grupo_id')) {
        $query->where('grupo_id', $request->grupo_id);
    }

    $asistencias = $query->with('estudiante', 'grupo')->orderBy('id', 'desc')->simplePaginate(10);

    return view('asistencias.index', compact('asistencias'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
    
        return view('asistencias.create', compact('estudiantes', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
            'estudiante_id' => 'required|integer|exists:estudiante,id',
            'grupo_id' => 'required|integer|exists:grupo,id',
        ]);
    
        // Creación de la asistencia
        Asistencia::create($validatedData);
    
        return redirect()->route('asistencias.index')->with('success', 'Asistencia creada correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        return view('asistencias.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $asistencia = Asistencia::find($id);
    if (!$asistencia) {
        return abort(404);
    }

    $estudiantes = Estudiante::all();
    $grupos = Grupo::all();

    return view('asistencias.edit', compact('asistencia', 'estudiantes', 'grupos'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
            'estudiante_id' => 'required|integer|exists:estudiante,id',
            'grupo_id' => 'required|integer|exists:grupo,id',
        ]);
    
        $asistencia = Asistencia::find($id);
    
        if (!$asistencia) {
            return abort(404);
        }
        
        $asistencia->update($validatedData);
    
        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $asistencia = Asistencia::find($id);

    if (!$asistencia) {
        return abort(404);
    }

    $asistencia->delete();

    return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente.');
}
}
