<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador.instalaciones.disciplinas', [
            'disciplinas' => Disciplina::all()->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('disciplina') OR empty($request->get('disciplina')))
            return response()->json(['message' => 'Datos Invalidos', 'status' => 400, 'data' => $request->toArray()], 400);

        $disciplina = new Disciplina(['nombre' => $request->get('disciplina')]);

        if($disciplina->save())
            return response()->json(['message' => 'Actualización Exitosa', 'status' => 200, 'data' => [true]], 200);
        else return response()->json(['message' => 'Error', 'status' => 500, 'data' => [false]], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if(!$request->has('disciplina') OR empty($request->get('disciplina')))
            return response()->json(['message' => 'Datos Invalidos', 'status' => 400, 'data' => $request->toArray()], 400);

        $disciplina = Disciplina::updateOrCreate(['id' => $request->get('id')]);
        $disciplina->nombre = $request->get('disciplina');
        if($disciplina->save())
            return response()->json(['message' => 'Actualización Exitosa', 'status' => 200, 'data' => [true]], 200);
        else return response()->json(['message' => 'Error', 'status' => 500, 'data' => [false]], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Disciplina::find($id)->delete());
    }
}
