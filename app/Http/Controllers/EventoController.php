<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\ImagenesEvento;
use App\Models\Prioridad;
use App\Models\TipoEvento;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador.eventos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposEvento = TipoEvento::all()->toArray();
        $prioridades = Prioridad::all()->toArray();

        \JavaScript::put([
            'tiposEvento' => $tiposEvento,
            'prioridades' => $prioridades,
        ]);

        return view('administrador.eventos.registro', ['tiposEvento' => $tiposEvento, 'prioridades' => $prioridades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('imgDestacada') OR !$request->has('nombre') OR !$request->has('tipo') OR
            !$request->has('descripcion') OR !$request->has('fechaInicio') OR !$request->has('fechaFin')
            OR !$request->has('prioridad')) {
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);
        }

        $img = $request->get('imgDestacada');
        $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

        $imgp = Image::make($info);
        $time = time();
        $imgp->save(public_path('storage/eventos/' . $time . '.jpg'));

        $nombres = $request->get('nombre');
        $tipo = $request->get('tipo');
        $descripcion = $request->get('descripcion');
        $prioridad = $request->get('prioridad');
        $fechaInicio = $request->get('fechaInicio');
        $fechaFin = $request->get('fechaFin');

        $evento = new Evento([
            'nombre' => $nombres,
            'tipo_evento_id' => $tipo,
            'descripcion' => $descripcion,
            'imagen_destacada' => 'storage/eventos/' . $time . '.jpg',
            'prioridad_id' => $prioridad,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin
        ]);

        return $evento->save() ?
            response()->json(['respuesta' => 'Información guardada', 'status' => 200, 'data' => $evento->toArray()], 200)
            : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = Evento::where(['id' => $id])->get()->toArray()[0];
        $tiposEvento = TipoEvento::all()->toArray();
        $prioridades = Prioridad::all()->toArray();

        \JavaScript::put([
            'tiposEvento' => $tiposEvento,
            'prioridades' => $prioridades,
            'event' => $evento
        ]);

        return view('administrador.eventos.registro', ['tiposEvento' => $tiposEvento, 'prioridades' => $prioridades, 'event' => $evento]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $evento = Evento::where(['id' => $id]);

        if (count($evento->get()->toArray()) < 1)
            return response()->json(['respuesta' => 'Not fount', 'status' => 404], 404);

        if ($request->has('imgDestacada') AND !empty($request->get('imgDestacada'))) {
            $img = $request->get('imgDestacada');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

            $imgp = Image::make($info);
            $time = time();
            $imgp->save(public_path('storage/eventos/' . $time . '.jpg'));

            $evento->update(['imagen_destacada' => 'storage/eventos/' . $time . '.jpg']);
        }

        if ($request->has('nombre') AND !empty($request->get('nombre'))) {
            $nombres = $request->get('nombre');
            $evento->update(['nombre' => $nombres]);
        }

        if ($request->has('tipo') AND !empty($request->get('tipo')) AND $request->get('tipo') != '0') {
            $tipo = $request->get('tipo');
            $evento->update(['tipo_evento_id' => $tipo]);
        }

        if ($request->has('prioridad') AND !empty($request->get('prioridad')) AND $request->get('prioridad') != '0') {
            $prioridad = $request->get('prioridad');
            $evento->update(['prioridad_id' => $prioridad]);
        }

        if ($request->has('descripcion') AND !empty($request->get('descripcion'))) {
            $descripcion = $request->get('descripcion');
            $evento->update(['descripcion' => $descripcion]);
        }

        if ($request->has('fechaInicio') AND !empty($request->get('fechaInicio'))) {
            $fechaInicio = $request->get('fechaInicio');
            $evento->update(['fecha_inicio' => $fechaInicio]);
        }

        if ($request->has('fechaFin') AND !empty($request->get('fechaFin'))) {
            $fechaFin = $request->get('fechaFin');
            $evento->update(['fecha_fin' => $fechaFin]);
        }

        return response()->json(['respuesta' => 'Ok', 'status' => 200, 'data' => $request->toArray()], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ImagenesEvento::where(['evento_id' => $id])->delete();
        return response()->json(Evento::find($id)->delete());
    }

    public function shows()
    {
        $dias = Evento::where('id', '!=', '0')->groupBy('fecha_inicio')->orderBy('fecha_inicio', 'ASC')->get(['fecha_inicio'])->toArray();
        $eventos = Evento::with(['prioridad', 'imagenesEventos'])->get()->toArray();

        $data = [];

        foreach ($dias as $dia) {
            $var = ['fecha' => date("M. j Y", strtotime($dia['fecha_inicio'])), 'dias' => []];
            foreach ($eventos as $e) {
                if ($e['fecha_inicio'] == $dia['fecha_inicio']) {
                    array_push($var['dias'], $e);
                }
            }
            array_push($data, $var);
        }

        return response()->json($data);
    }

    public function obtenerImagenesInstalacion($id)
    {
        return response()->json(ImagenesEvento::where(['evento_id' => $id])->get()->toArray());
    }

    public function eliminarImagenEvento($id)
    {
        $imagen = ImagenesEvento::where(['id' => $id]);
        Storage::delete($imagen->get()->toArray()[0]['url']);
        return response()->json([$imagen->delete()]);
    }

    public function cargarImagenesEvento(Request $request)
    {
        {
            $size = number_format($request->file('file')->getSize() / 1048576, 2);

            if ($size > 2.5) return response()->json('Tamaño Excedido ' . $size . 'MB', 400);

            $id_evento = $request->get('id_evento');
            $evento = Evento::where(['id' => $id_evento])->get()->toArray();

            if (count($evento) < 1) return response()->json(['respuesta' => 'Error', 'status' => 404, 'data' => $request->toArray()], 404);

            $file = $request->file('file');
            $time = time();
            $file->storeAs('public/eventos', $time . '.' . $file->extension());

            $evento_imagen = new ImagenesEvento(['evento_id' => $id_evento, 'url' => 'storage/eventos/' . $time . '.' . $file->extension()]);

            return $evento_imagen->save() ?
                response()->json([
                    'respuesta' => 'Información guardada',
                    'status' => 200,
                    'data' => ImagenesEvento::where(['evento_id' => $id_evento])->get()->toArray()], 200)
                : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
        }
    }
}
