<?php

namespace App\Http\Controllers;

use App\Models\CategoriaGolfista;
use App\Models\TipoDocumento;
use App\Models\TipoUsuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use JavaScript;

class AfiliadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador.afiliados.index', [
            'afiliados' => User::with(['categoriaGolfista', 'estadoUser', 'tipoDocumento', 'tipoUsuario'])->get()->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        JavaScript::put([
            'categoriasGolfista' => CategoriaGolfista::all()->toArray()
        ]);

        return view('administrador.afiliados.registro', [
            'tiposDocumento' => TipoDocumento::all()->toArray(),
            'tiposUsuario' => TipoUsuario::all()->toArray(),
            'categoriasGolfista' => CategoriaGolfista::all()->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Response $response
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Response $response)
    {

        if (!$this->validarRequestAfiliados($request))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400], 400);

        $nombres = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $email = $request->get('email');
        $tipo_documento = $request->get('tipo_documento');
        $documento = $request->get('documento');
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $telefono = $request->get('telefono');
        $direccion = $request->get('direccion');
        $genero = $request->get('genero');
        $codigo_afiliado = $request->get('codigo_afiliado');
        $tipo_usuario = $request->get('tipo_usuario');

        $categoria_golfista = null;
        $codigo_golfista = null;

        if ($request->get('tipo_usuario') == '3') {
            if ($request->has('categoria_golfista') AND $request->has('codigo_golfista')) {
                $categoria_golfista = $request->get('categoria_golfista');
                $codigo_golfista = $request->get('codigo_golfista');
            }
        }

        $usuario = new User([
            'email' => $email,
            'password' => Hash::make('CC' . $documento),
            'name' => $nombres,
            'tipo_documento_id' => $tipo_documento,
            'categoria_golfista_id' => $categoria_golfista,
            'estado_users_id' => 1,
            'documento' => $documento,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'fecha_naci' => $fecha_nacimiento,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'genero' => $genero,
            'codigo_afiliado' => $codigo_afiliado,
            'codigo_golfista' => $codigo_golfista,
            'tipo_usuario_id' => $tipo_usuario
        ]);

        return $usuario->save() ?
            response()->json(['respuesta' => 'Información guardada', 'status' => 200], 200)
            : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
    }

    private function validarRequestAfiliados(Request $request)
    {
        if (!$request->has('nombres') || !$request->has('apellidos') || !$request->has('email') ||
            !$request->has('tipo_documento') || !$request->has('documento') || !$request->has('fecha_nacimiento') ||
            !$request->has('telefono') || !$request->has('direccion') || !$request->has('genero') ||
            !$request->has('tipo_usuario'))
            return false;

        if ($request->get('tipo_usuario') != 2) {
            if (!$request->has('codigo_afiliado'))
                return false;
        }

        if ($request->get('tipo_usuario') == 3) {
            if (!$request->has('categoria_golfista') || !$request->has('codigo_golfista'))
                return false;
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $afiliado = User::where(['id' => $id, 'estado_users_id' => 1])->get()->toArray()[0];

        JavaScript::put([
            'afiliado' => $afiliado,
            'categoriasGolfista' => CategoriaGolfista::all()->toArray()
        ]);

        return view('administrador.afiliados.registro', [
            'afiliado' => $afiliado,
            'tiposDocumento' => TipoDocumento::all()->toArray(),
            'tiposUsuario' => TipoUsuario::all()->toArray(),
            'categoriasGolfista' => CategoriaGolfista::all()->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->validarRequestAfiliados($request))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400], 400);

        $nombres = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $email = $request->get('email');
        $tipo_documento = $request->get('tipo_documento');
        $documento = $request->get('documento');
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $telefono = $request->get('telefono');
        $direccion = $request->get('direccion');
        $genero = $request->get('genero');
        $codigo_afiliado = $request->get('codigo_afiliado');
        $tipo_usuario = $request->get('tipo_usuario');

        $categoria_golfista = null;
        $codigo_golfista = null;

        if ($request->get('tipo_usuario') == 3) {
            if (!$request->has('categoria_golfista') || !$request->has('codigo_golfista')) {
                $categoria_golfista = $request->get('categoria_golfista');
                $codigo_golfista = $request->get('codigo_golfista');
            }
        }

        $afiliado = User::updateOrCreate(['id' => $request->get('id')]);
        $afiliado->email = $email;
        $afiliado->tipo_documento_id = $tipo_documento;
        $afiliado->tipo_usuario_id = $tipo_usuario;
        $afiliado->categoria_golfista_id = $categoria_golfista;
        $afiliado->estado_users_id = 1;
        $afiliado->documento = $documento;
        $afiliado->nombres = $nombres;
        $afiliado->apellidos = $apellidos;
        $afiliado->fecha_naci = $fecha_nacimiento;
        $afiliado->telefono = $telefono;
        $afiliado->direccion = $direccion;
        $afiliado->genero = $genero;
        $afiliado->codigo_afiliado = $codigo_afiliado;
        $afiliado->codigo_golfista = $codigo_golfista;

        return response()->json($afiliado->save(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(User::find($id)->delete());
    }
}
