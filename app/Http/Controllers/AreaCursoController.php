<?php

namespace App\Http\Controllers;

use App\Models\AreaCurso;
use Illuminate\Http\Request;

class AreaCursoController extends Controller
{
    // MIDDLEWARE QUE PROTEGE LA RUTA
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areaActiva = AreaCurso::with("UsuarioCreador", "UsuarioModificador", "TipoDeCurso")->where('estado', 'ACTIVO')->get();
        $areaGeneral = AreaCurso::with("UsuarioCreador", "UsuarioModificador", "TipoDeCurso")->get();

        return response()->json(compact('areaActiva', 'areaGeneral'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = auth()->user();
        // "tipo_id", "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"

        $request->validate([
            "tipo_id" => "required|integer",
            "nombre" => "required|string|unique:area_cursos,nombre",
            "estado" => "required|string",
            "UsuarioCreacion" => "integer"
        ]);

        $area = new AreaCurso;
        $area->tipo_id = $request->get('tipo_id');
        $area->nombre = $request->get('nombre');
        $area->estado = $request->get('estado');
        $area->UsuarioCreacion = $usuario->id;
        $area->save();

        $message = "Area de Curso Creada con exito!";

        return response()->json(compact('message', 'area'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = AreaCurso::with("UsuarioCreador", "UsuarioModificador", "TipoDeCurso", "Curso", "Curso.AreaDeCurso")->find($id);

        return response()->json(compact('area'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = auth()->user();
        // "tipo_id", "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"

        $request->validate([
            "tipo_id" => "integer",
            "nombre" => "string",
            "estado" => "string",
            "UsuarioModificacion" => "integer"
        ]);

        $area = AreaCurso::find($id);
        $request->get('tipo_id') == null ? $area->tipo_id = $area->tipo_id : $area->tipo_id = $request->get('tipo_id');
        $request->get('nombre') == null ? $area->nombre = $area->nombre : $area->nombre = $request->get('nombre');
        $request->get('estado') == null ? $area->estado = $area->estado : $area->estado = $request->get('estado');
        $area->UsuarioModificacion = $usuario->id;
        $area->update();

        $message = "Area de Curso Modificada con exito!";

        return response()->json(compact('message', 'area'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = AreaCurso::find($id);
        $area->estado = "INACTIVO";
        $area->update();

        $message = "Area de Curso INACTIVADA con exito!";

        return response()->json(compact('message', 'area'), 200);
    }
}
