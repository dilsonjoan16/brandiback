<?php

namespace App\Http\Controllers;

use App\Models\ModalidadCurso;
use Illuminate\Http\Request;

class ModalidadCursoController extends Controller
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
        $modalidadActiva = ModalidadCurso::with("UsuarioCreador", "UsuarioModificador")->where('estado', 'ACTIVO')->get();
        $modalidadGeneral = ModalidadCurso::with("UsuarioCreador", "UsuarioModificador")->get();

        return response()->json(compact('modalidadActiva', 'modalidadGeneral'), 200);

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
        // "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"
        $request->validate([
            "nombre" => "required|string|unique:modalidad_cursos,nombre",
            "estado" => "required|string",
            "UsuarioCreacion" => "integer"
        ]);

        $modalidad = new ModalidadCurso;
        $modalidad->nombre = $request->get('nombre');
        $modalidad->estado = $request->get('estado');
        $modalidad->UsuarioCreacion = $usuario->id;
        $modalidad->save();

        $message = 'Modalidad de Cursos Creada con exito!';

        return response()->json(compact('message', 'modalidad'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modalidad = ModalidadCurso::with("UsuarioCreador", "UsuarioModificador")->find($id);

        return response()->json(compact('modalidad'), 200);
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
        // "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"
        $request->validate([
            "nombre" => "string|unique:modalidad_cursos,nombre",
            "estado" => "string",
            "UsuarioModificacion" => "integer"
        ]);

        $modalidad = ModalidadCurso::find($id);
        $request->get('nombre') == null ? $modalidad->nombre = $modalidad->nombre : $modalidad->nombre = $request->get('nombre');
        $request->get('estado') == null ? $modalidad->estado = $modalidad->estado : $modalidad->estado = $request->get('estado');
        $modalidad->UsuarioModificacion = $usuario->id;
        $modalidad->update();

        $message = "Modalidad de Curso Modificada con exito!";

        return response()->json(compact('message', 'modalidad'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modalidad = ModalidadCurso::find($id);
        $modalidad->estado = "INACTIVO";
        $modalidad->update();

        $message = "Modalidad de Curso Inactivada con exito!";

        return response()->json(compact('message', 'modalidad'), 200);
    }
}
