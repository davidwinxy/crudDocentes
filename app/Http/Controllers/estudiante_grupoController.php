<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estudiante_grupo; // Asegúrate de importar el modelo correcto
use App\Models\Estudiante;
use App\Models\Grupo;

class estudiante_grupoController extends Controller
{
    public function index(Request $request)
    {
        $query = estudiante_grupo::query();

        if ($request->has('estudiante_id') && is_numeric($request->estudiante_id)) {
            $query->where('estudiante_id', $request->estudiante_id);
        }

        $estudiantesGrupos = $query->with('estudiante', 'grupo')
            ->orderByDesc('id')
            ->simplePaginate(10);

        $estudiantes = Estudiante::all();
        return view('estudiantes_grupo.index', compact('estudiantesGrupos', 'estudiantes'));
    }

    public function create()
    {
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('estudiantes_grupo.create', compact('estudiantes', 'grupos'));
    }

    public function store(Request $request)
    {
        $estudianteGrupo = estudiante_grupo::create($request->all());

        return redirect()->route('estudiantes_grupo.index')->with('success', 'Estudiante grupo creado correctamente.');
    }

    public function show($id)
    {
        $estudianteGrupo = estudiante_grupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        return view('estudiantes_grupo.show', compact('estudianteGrupo'));
    }

    public function edit($id)
    {
        $estudianteGrupo = estudiante_grupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();

        return view('estudiantes_grupo.edit', compact('estudianteGrupo', 'estudiantes', 'grupos'));
    }

    public function update(Request $request, $id)
    {
        $estudianteGrupo = estudiante_grupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        $estudianteGrupo->estudiante_id = $request->estudiante_id;
        $estudianteGrupo->grupo_id = $request->grupo_id;

        $estudianteGrupo->save();

        return redirect()->route('estudiantes_grupo.index')->with('success', 'Estudiante grupo actualizado correctamente.');
    }

    public function delete($id)
    {
        $estudianteGrupo = estudiante_grupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        return view('estudiantes_grupo.delete', compact('estudianteGrupo'));
    }

    public function destroy($id)
    {
        $estudianteGrupo = estudiante_grupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        $estudianteGrupo->delete();

        return redirect()->route('estudiantes_grupo.index')->with('success', 'Estudiante grupo eliminado correctamente.');
    }
}
