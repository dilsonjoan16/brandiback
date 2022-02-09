<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','perfil']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = $this->respondWithToken($token);
        $usuario = auth()->user();
        return response()->json(compact('token', 'usuario'), 200) ;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function register(Request $request){

        $usuario = auth()->user();
        //
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6|max:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
                'rol' => 'string|in:Admin,Comun',
                'estado' => 'string|in:ACTIVO,INACTIVO',
                'UsuarioCreacion' => 'integer',

        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $request->get('rol') == null ? $user->rol = "Comun" : $user->rol = $request->get('rol');
        $request->get('estado') == null ? $user->estado = "ACTIVO" : $user->rol = $request->get('rol');
        $request->get('UsuarioCreacion') == null ? $user->UsuarioCreacion = 1 : $user->UsuarioCreacion = $usuario->id;
        $user->save();

        return response()->json(compact('user'),201);

    	// $validator = Validator::make($request->all(), [
    	// 	'name' => 'required',
    	// 	'email' => 'required|string|email|max:100|unique:users',
    	// 	'password' => 'required|string|min:6|max:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
    	// ]);

    	// if($validator->fails()){
    	// 	return response()->json($validator->errors()->toJson(),400);
    	// }

    	// $user = User::create(array_merge(
    	// 	$validator->validate(),
    	// 	['password' => Hash::make($request->get('password'))]
    	// ));

    	// return response()->json([
    	// 	'message' => 'User logged Successfully',
    	// 	'user' => $user
    	// ], 201);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1440
        ]);
    }

    public function perfil($id)
    {
        $usuario = User::find($id);

        return response()->json(compact('usuario'), 200);
    }

    public function modificar(Request $request, $id)
    {

        $usuario = auth()->user();

        $request->validate([
            'name' => 'string|max:100',
            'email' => 'string|email|max:100',
            // 'password' => 'string|min:6|max:12',
            'rol' => 'string|in:Admin,Comun',
            'estado' => 'string|in:ACTIVO,INACTIVO',
            'UsuarioModificacion' => 'integer',
        ]);

        $user = User::find($id);
        $request->get('name') == null || $request->get('name') == "" ? $user->name = $user->name : $user->name = $request->get('name');
        $request->get('email') == null || $request->get('email') == "" ? $user->email = $user->email : $user->email = $request->get('email');
        $request->get('password') == null || $request->get('password') == "" ? $user->password = $user->password : $user->password = Hash::make($request->get('password'));
        $user->rol == "Admin" ? $user->rol = "Admin" : $user->rol = "Comun";
        // $request->get('rol') == null || $request->get('rol') == "" ? $user->rol = "Comun" : $user->rol = $request->get('rol');
        $request->get('estado') == null || $request->get('estado') == "" ? $user->estado = "ACTIVO" : $user->rol = $request->get('rol');
        $request->get('UsuarioModificacion') == null ? $user->UsuarioModificacion = 1 : $user->UsuarioModificacion = $usuario->id;
        $user->update();

        return response()->json(compact('user'), 200);
    }

    public function usuarios()
    {
        $user = User::with(
        'UsuarioCreador',
        'UsuarioModificador',
        )->get();

        return response()->json(compact('user'), 200);
    }

    public function modificarAdmin(Request $request, $id)
    {
        $usuario = auth()->user();

        $request->validate([
            'name' => 'string|max:100',
            'email' => 'string|email|max:100',
            // 'password' => 'string|min:6|max:12',
            'rol' => 'string|in:Admin,Comun',
            'estado' => 'string|in:ACTIVO,INACTIVO',
            'UsuarioModificacion' => 'integer',
        ]);

        $user = User::find($id);
        $request->get('name') == null || $request->get('name') == "" ? $user->name = $user->name : $user->name = $request->get('name');
        $request->get('email') == null || $request->get('email') == "" ? $user->email = $user->email : $user->email = $request->get('email');
        $request->get('password') == null || $request->get('password') == "" ? $user->password = $user->password : $user->password = Hash::make($request->get('password'));
        // $user->rol = "Comun";
        $request->get('rol') == null || $request->get('rol') == "" ? $user->rol = "Comun" : $user->rol = $request->get('rol');
        $request->get('estado') == null || $request->get('estado') == "" ? $user->estado = "ACTIVO" : $user->rol = $request->get('rol');
        // $request->get('UsuarioModificacion') == null ? $user->UsuarioModificacion = 1 : $user->UsuarioModificacion = $usuario->id;
        $user->UsuarioModificacion = $usuario->id;
        $user->update();

        return response()->json(compact('user'), 200);
    }

    public function createAdmin(Request $request)
    {
        $usuario = auth()->user();
        //
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6|max:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
                'rol' => 'required|string|in:Admin,Comun',
                'estado' => 'required|string|in:ACTIVO,INACTIVO',
                'UsuarioCreacion' => 'integer',

        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        // $request->get('rol') == null ? $user->rol = "Comun" : $user->rol = $request->get('rol');
        $user->rol = $request->get('rol');
        // $request->get('estado') == null ? $user->estado = "ACTIVO" : $user->rol = $request->get('rol');
        $user->estado = $request->get('estado');
        // $request->get('UsuarioCreacion') == null ? $user->UsuarioCreacion = 1 : $user->UsuarioCreacion = $usuario->id;
        $user->UsuarioCreacion = $usuario->id;
        $user->save();

        return response()->json(compact('user'),201);
    }

    public function onlyAdmin(Request $request)
    {
        $usuario = auth()->user();
        //
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6|max:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
                // 'rol' => 'string|in:Admin,Comun',
                // 'estado' => 'string|in:ACTIVO,INACTIVO',
                'UsuarioCreacion' => 'integer',

        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        // $request->get('rol') == null ? $user->rol = "Admin" : $user->rol = $request->get('rol');
        $user->rol = "Admin";
        // $request->get('estado') == null ? $user->estado = "ACTIVO" : $user->rol = $request->get('rol');
        $user->estado = "ACTIVO";
        // $request->get('UsuarioCreacion') == null ? $user->UsuarioCreacion = 1 : $user->UsuarioCreacion = $usuario->id;
        $user->UsuarioCreacion = $usuario->id;
        $user->save();

        return response()->json(compact('user'),201);
    }

    public function eliminar($id)
    {
        $user = User::find($id);
        $user->estado = "INACTIVO";
        $user->update();

        return response()->json(compact('user'), 200);
    }
}
