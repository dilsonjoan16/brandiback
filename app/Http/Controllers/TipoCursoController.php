<?php

namespace App\Http\Controllers;

use App\Models\TipoCurso;
use Illuminate\Http\Request;

class TipoCursoController extends Controller
{
    // MIDDLEWARE QUE PROTEGE LA RUTA
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoActivo = TipoCurso::with("UsuarioCreador", "UsuarioModificador", "ModalidadDeCurso")->where('estado', 'ACTIVO')->get();
        $tipoGeneral = TipoCurso::with("UsuarioCreador", "UsuarioModificador", "ModalidadDeCurso")->get();

        return response()->json(compact('tipoActivo', 'tipoGeneral'), 200);
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
        //  "modalidad_id", "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"
        $request->validate([
           "modalidad_id" => "required|integer",
           "nombre" => "required|string|unique:tipo_cursos,nombre",
           "estado" => "required|string",
           "UsuarioCreacion" => "integer"
        ]);

        $tipo = new TipoCurso;
        $tipo->modalidad_id = $request->get('modalidad_id');
        $tipo->nombre = $request->get('nombre');
        $tipo->estado = $request->get('estado');
        $tipo->UsuarioCreacion = $usuario->id;
        $tipo->save();

        $message = "Tipo de Curso Creado con exito!";

        return response()->json(compact('message', 'tipo'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = TipoCurso::with("UsuarioCreador", "UsuarioModificador", "ModalidadDeCurso")->find($id);

        return response()->json(compact('tipo'), 200);
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
        //  "modalidad_id", "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"
        $request->validate([
           "modalidad_id" => "integer",
           "nombre" => "string|unique:tipo_cursos,nombre",
           "estado" => "string",
           "UsuarioModificacion" => "integer"
        ]);

        $tipo = TipoCurso::find($id);
        $request->get('modalidad_id') == null ? $tipo->modalidad_id = $tipo->modalidad_id : $tipo->modalidad_id = $request->get('modalidad_id');
        $request->get('nombre') == null ? $tipo->nombre = $tipo->nombre : $tipo->nombre = $request->get('nombre');
        $request->get('estado') == null ? $tipo->estado = $tipo->estado : $tipo->estado = $request->get('estado');
        $tipo->UsuarioModificacion = $usuario->id;
        $tipo->update();

        $message = "Tipo de Curso Modificado con exito!";

        return response()->json(compact('message', 'tipo'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = TipoCurso::find($id);
        $tipo->estado = "INACTIVO";
        $tipo->update();

        $message = "Tipo de Curso INACTIVADO con exito!";

        return response()->json(compact('message', 'tipo'), 200);
    }
}
