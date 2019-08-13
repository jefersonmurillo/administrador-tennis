<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\ImagenesInstalacion;
use App\Models\Instalacion;
use App\Models\TipoInstalacion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Image;

class InstalacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \JavaScript::put([
            'instalaciones' => Instalacion::with(['tipoInstalacion'])->get()->toArray(),
        ]);
        
        return view('administrador.instalaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \JavaScript::put([
            'disciplinas' => Disciplina::all()->toArray(),
        ]);

        return view('administrador.instalaciones.registro', [
            'tiposInstalacion' => TipoInstalacion::all()->toArray(),
            'disciplinas' => Disciplina::all()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('imgDestacada') OR !$request->has('nombre') OR !$request->has('tipo') OR !$request->has('descripcion'))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);

        $img = $request->get('imgDestacada');
        $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

        $imgp = Image::make($info);
        $time = time();
        $imgp->save(public_path('storage/instalaciones/' . $time . '.jpg'));

        $nombres = $request->get('nombre');
        $tipo = $request->get('tipo');
        $descripcion = $request->get('descripcion');

        $instalacion = new Instalacion([
            'nombre' => $nombres,
            'tipo_instalacion_id' => $tipo,
            'descripcion' => $descripcion,
            'imagen_destacada' => 'storage/instalaciones/' . $time . '.jpg'
        ]);

        return $instalacion->save() ?
            response()->json(['respuesta' => 'Información guardada', 'status' => 200, 'data' => $instalacion->toArray()], 200)
            : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        \JavaScript::put([
            'disciplinas' => Disciplina::all()->toArray(),
            'insta' => Instalacion::where(['id' => $id])->get()->toArray()[0],
            'tiposInstalacion' => TipoInstalacion::all()->toArray(),
        ]);

        return view('administrador.instalaciones.registro', [
            'tiposInstalacion' => TipoInstalacion::all()->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instalacion = Instalacion::where(['id' => $id]);

        if (count($instalacion->get()->toArray()) < 1)
            return response()->json(['respuesta' => 'Not fount', 'status' => 404], 404);

        if($request->has('imgDestacada') AND !empty($request->get('imgDestacada'))){
            $img = $request->get('imgDestacada');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

            $imgp = Image::make($info);
            $time = time();
            $imgp->save(public_path('storage/instalaciones/' . $time . '.jpg'));

            $instalacion->update(['imagen_destacada' => 'storage/instalaciones/' . $time . '.jpg']);
        }

        if($request->has('nombre') AND !empty($request->get('nombre'))){
            $nombres = $request->get('nombre');
            $instalacion->update(['nombre' => $nombres]);
        }

        if($request->has('tipo') AND !empty($request->get('tipo')) AND $request->get('tipo') != '0'){
            $tipo = $request->get('tipo');
            $instalacion->update(['tipo_instalacion_id' => $tipo]);
        }

        if($request->has('descripcion') AND !empty($request->get('descripcion'))){
            $descripcion = $request->get('descripcion');
            $instalacion->update(['descripcion' => $descripcion]);
        }

        return response()->json(['respuesta' => 'Ok', 'status' => 200], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Instalacion::find($id)->delete());
    }

    public function cargarImagenesInstalacion(Request $request)
    {
        $size = number_format($request->file('file')->getSize() / 1048576, 2);

        if ($size > 2.5) return response()->json('Tamaño Excedido ' . $size . 'MB', 400);

        $id_instalacion = $request->get('id_instalación');
        $instalacion = Instalacion::where(['id' => $id_instalacion])->get()->toArray();

        if (count($instalacion) < 1) return response()->json(['respuesta' => 'Error', 'status' => 404], 404);

        $file = $request->file('file');
        $time = time();
        $file->storeAs('public/instalaciones', $time . '.' . $file->extension());

        $instalacion_imagen = new ImagenesInstalacion(['instalacion_id' => $id_instalacion, 'url' => 'storage/instalaciones/' . $time . '.' . $file->extension()]);

        return $instalacion_imagen->save() ?
            response()->json([
                'respuesta' => 'Información guardada',
                'status' => 200,
                'data' => ImagenesInstalacion::where(['instalacion_id' => $id_instalacion])->get()->toArray()], 200)
            : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
    }

    public function obtenerImagenesInstalacion($id)
    {
        return response()->json(ImagenesInstalacion::where(['instalacion_id' => $id])->get()->toArray());
    }

    public function eliminarImagenInstalacion($id){
        $imagen = ImagenesInstalacion::where(['id' => $id]);
        Storage::delete($imagen->get()->toArray()[0]['url']);
        return response()->json([$imagen->delete()]);
    }
}
