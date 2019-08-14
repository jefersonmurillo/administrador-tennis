<?php

namespace App\Http\Controllers;

use App\Models\Pqrs;
use App\Models\SugerenciaSabor;
use Illuminate\Http\Request;

use Image;

class OtrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPQRS()
    {
        return view('administrador.pqrs.index');
    }

    public function obtenerMensajesPqrs(){
        return response()->json(Pqrs::with(['usuario'])->orderBy('created_at', 'DESC')->get()->toArray());
    }

    public function indexSugerencia(){
        $sugerencias = SugerenciaSabor::where(['tipo' => '1'])->orderBy('created_at', 'DESC')->get()->toArray();
        return view('administrador.sugerencias.index', ['sugerencia' => count($sugerencias) > 0 ? $sugerencias[0] : []]);
    }

    public function indexSabor(){
        $sabore = SugerenciaSabor::where(['tipo' => '0'])->orderBy('created_at', 'DESC')->get()->toArray();
        return view('administrador.sabor.index', ['sabore' => count($sabore) > 0 ? $sabore[0] : []]);
    }

    public function cargarSugerencia(Request $request){
        $img = $request->get('img');
        $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

        $imgp = Image::make($info);
        $time = time();
        $imgp->save(public_path('storage/sugerencias/' . $time . '.jpg'));

        $sugerencia = new SugerenciaSabor([
            'url' => 'storage/sugerencias/' . $time . '.jpg',
            'tipo' => '1',
            'fecha' => date('Y-m-d')
        ]);

        if($sugerencia->save())return response()->json([], 200);
        else return response()->json([], 500);
    }

    public function cargarSabor(Request $request){
        $img = $request->get('img');
        $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

        $imgp = Image::make($info);
        $time = time();
        $imgp->save(public_path('storage/sabor/' . $time . '.jpg'));

        $sugerencia = new SugerenciaSabor([
            'url' => 'storage/sabor/' . $time . '.jpg',
            'tipo' => '0',
            'fecha' => date('Y-m-d')
        ]);

        if($sugerencia->save())return response()->json([], 200);
        else return response()->json([], 500);
    }

}
