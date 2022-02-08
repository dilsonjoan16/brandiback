<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
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
        $cursoActivo = Curso::with("UsuarioCreador", "UsuarioModificador", "AreaDeCurso")->where('estado', 'ACTIVO')->get();
        $cursoGeneral = Curso::with("UsuarioCreador", "UsuarioModificador", "AreaDeCurso")->get();

        return response()->json(compact('cursoActivo', 'cursoGeneral'), 200);
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
        // "area_id", "nombre", "estado", "descripcion", "duracion", "UsuarioCreacion", "UsuarioModificacion"

        $request->validate([
            "area_id" => "required|integer",
            "nombre" => "required|string|unique:cursos,nombre",
            "estado" => "required|string",
            "descripcion" => "required|string",
            "duracion" => "required|integer",
            "UsuarioCreacion" => "integer"
        ]);

        $curso = new Curso;
        $curso->area_id = $request->get('area_id');
        $curso->nombre = $request->get('nombre');
        $curso->estado = $request->get('estado');
        $curso->descripcion = $request->get('descripcion');
        $curso->duracion = $request->get('duracion');
        $curso->UsuarioCreacion = $usuario->id;
        $curso->save();

        $message = "Curso Creado con exito!";

        return response()->json(compact('message', 'curso'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::with("UsuarioCreador", "UsuarioModificador", "AreaDeCurso")->find($id);

        return response()->json(compact('curso'), 200);
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
        // "area_id", "nombre", "estado", "descripcion", "duracion", "UsuarioCreacion", "UsuarioModificacion"

        $request->validate([
            "area_id" => "integer",
            "nombre" => "string|unique:cursos,nombre",
            "estado" => "string",
            "descripcion" => "required|string",
            "duracion" => "integer",
            "UsuarioModificacion" => "integer"
        ]);

        $curso = Curso::find($id);
        $request->get('area_id') == null ? $curso->area_id = $curso->area_id : $curso->area_id = $request->get('area_id');
        $request->get('nombre') == null ? $curso->nombre = $curso->nombre : $curso->nombre = $request->get('nombre');
        $request->get('estado') == null ? $curso->estado = $curso->estado : $curso->estado = $request->get('estado');
        $request->get('descripcion') == null ? $curso->descripcion = $curso->descripcion : $curso->descripcion = $request->get('descripcion');
        $request->get('duracion') == null ? $curso->duracion = $curso->duracion : $curso->duracion = $request->get('duracion');
        $curso->UsuarioModificacion = $usuario->id;
        $curso->update();

        $message = "Curso Modificado con exito!";

        return response()->json(compact('message', 'curso'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->estado = "INACTIVO";
        $curso->update();

        $message = "Curso INACTIVADO con exito!";

        return response()->json(compact('message', 'curso'), 200);
    }
}
