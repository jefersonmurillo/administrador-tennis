<?php

namespace App\Http\Controllers;

use App\Models\Escenario;
use App\Models\ProgramadorEscenario;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class TeeTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escenarios = Escenario::with(['disciplina', 'programador'])->get()->toArray();
        $data = [];

        foreach ($escenarios as $escenario) {
            $disponibles = [];
            $aprobadas = [];
            $desaprobadas = [];
            $pendientes = [];
            foreach ($escenario['programador'] as $dia) {
                if ($dia['estado'] == 'RESERVADO') array_push($pendientes, $dia);
                elseif ($dia['estado'] == 'DESAPROBADO') array_push($desaprobadas, $dia);
                elseif ($dia['estado'] == 'APROBADO') array_push($aprobadas, $dia);
                elseif ($dia['estado'] == 'DISPONIBLE') array_push($disponibles, $dia);
            }

            $escenario['disponibles'] = $disponibles;
            $escenario['aprobados'] = $aprobadas;
            $escenario['desaprobados'] = $desaprobadas;
            $escenario['pendientes'] = $pendientes;

            array_push($data, $escenario);
        }

        return response()->json($data);
    }

    public function show($id)
    {
        $escenario = Escenario::where(['id' => $id])->with([
            'programador.jugador1',
            'programador.jugador2',
            'programador.jugador3',
            'programador.jugador4',
        ])->get()->toArray()[0];
        \JavaScript::put([
            'escenario' => $escenario
        ]);

        return view('administrador.tee-time.programador', [
            'escenario' => $escenario
        ]);
    }

    public function eliminarFechaDiaHoraProgramada(Request $request){
        if($request->get('id') == 'undefined'){
            return ProgramadorEscenario::where(['fecha' => $request->get('fecha')])->delete() ? response()->json([
                'respuesta' => 'Información guardada',
                'status' => 200,
                'data' => [$request->toArray()]], 200)
                : response()->json(['respuesta' => 'Error', 'data' => $request->toArray(), 'status' => 500], 500);
        }else {
            return ProgramadorEscenario::where(['id' => $request->get('id')])->delete() ? response()->json([
                'respuesta' => 'Información guardada',
                'status' => 200,
                'data' => [$request->toArray()]], 200)
                : response()->json(['respuesta' => 'Error', 'data' => $request->toArray(), 'status' => 500], 500);
        }

    }

    public function registrarEscenario(Request $request)
    {
        if (!$request->has('nombre') OR !$request->has('disciplina'))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);

        $nombre = $request->get('nombre');
        $disciplina = $request->get('disciplina');

        if ($request->has('id')) {
            $result = Escenario::where(['id' => $request->get('id')])->update(['nombre' => $nombre, 'disciplina_id' => $disciplina]);
        } else {
            $escenario = new Escenario(['nombre' => $nombre, 'disciplina_id' => $disciplina]);
            $result = $escenario->save();
        }

        return $result ? response()->json([
            'respuesta' => 'Información guardada',
            'status' => 200,
            'data' => [$request->toArray()]], 200)
            : response()->json(['respuesta' => 'Error', 'data' => $request->toArray(), 'status' => 500], 500);
    }

    public function eliminarEscenario(Request $request){
        return response()->json(Escenario::find($request->get('id'))->delete());
    }

    public function fechasProgramadasEscenario($id)
    {
        return response()->json(ProgramadorEscenario::where(['escenario_id' => $id])->groupBy('fecha')->get(['fecha'])->toArray());
    }

    public function reservacionesEscenarioFecha($id, $fecha)
    {
        $reservaciones = ProgramadorEscenario::where(['escenario_id' => $id, 'fecha' => $fecha])
            ->with(['jugador1', 'jugador2', 'jugador3', 'jugador4'])->get()->toArray();

        $data = [];

        foreach ($reservaciones as $reservacion) {
            $item = $reservacion;
            if ($reservacion['estado'] == 'RESERVADO') {
                $item['jugador1'] = [
                    'id' => $reservacion['grupo_jugadores_golf']['jugador1']['id'],
                    'nombres' => $reservacion['grupo_jugadores_golf']['jugador1']['nombres'],
                    'apellidos' => $reservacion['grupo_jugadores_golf']['jugador1']['apellidos']
                ];

                $item['jugador2'] = [
                    'id' => $reservacion['grupo_jugadores_golf']['jugador2']['id'],
                    'nombres' => $reservacion['grupo_jugadores_golf']['jugador2']['nombres'],
                    'apellidos' => $reservacion['grupo_jugadores_golf']['jugador2']['apellidos']
                ];

                $item['jugador3'] = [
                    'id' => $reservacion['grupo_jugadores_golf']['jugador3']['id'],
                    'nombres' => $reservacion['grupo_jugadores_golf']['jugador3']['nombres'],
                    'apellidos' => $reservacion['grupo_jugadores_golf']['jugador3']['apellidos']
                ];

                if ($item['jugador4'] != null) {
                    $item['jugador4'] = [
                        'id' => $reservacion['grupo_jugadores_golf']['jugador4']['id'],
                        'nombres' => $reservacion['grupo_jugadores_golf']['jugador4']['nombres'],
                        'apellidos' => $reservacion['grupo_jugadores_golf']['jugador4']['apellidos']
                    ];
                }
                array_push($data, $item);
            } else array_push($data, $item);
        }
        return response()->json($reservaciones);
    }

    public function obtenerDiasEstado($id, $estado)
    {
        if ($estado == 'TODOS') {
            $escenario = Escenario::where(['id' => $id])->with(['disciplina', 'programador' => function ($query) {
                $query->orderBy('fecha', 'desc')->get();
            }])->get()->toArray()[0];
        } else {
            $escenario = Escenario::where(['id' => $id])->with(['disciplina', 'programador' => function ($query) use ($estado) {
                $query->where(['estado' => $estado])->orderBy('fecha', 'desc')
                    ->get(['id', 'fecha', 'hora', 'estado', 'grupo_jugadores_golf']);
            }])->get()->toArray()[0];
        }

        return response()->json($escenario);
    }

    public function registrarProgramacionEscenario(Request $request)
    {
        if (!$request->has('id') OR !$request->has('fecha') OR !$request->has('hora'))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);

        $hora = $request->get('hora');

        $hora = explode(' ', $hora);
        if ($hora[1] == 'PM') {
            $hour = explode(':', $hora[0]);
            $min = $hour[1];
            $hour = intval($hour[0]) + 12;
            $hora = $hour . ':' . $min . ':00.000000';
        } else $hora = $hora[0] . ':00.000000';

        $programa = new ProgramadorEscenario([
            'escenario_id' => $request->get('id'),
            'fecha' => $request->get('fecha'),
            'hora' => $hora,
            'estado' => 'DISPONIBLE'
        ]);

        return $programa->save() ?
            response()->json([
                'respuesta' => 'Información guardada',
                'status' => 200,
                'data' => []], 200)
            : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
    }

    public function cambiarEstadoDiaProgramado(Request $request)
    {
        if (!$request->has('id') OR $request->get('id') == '' OR !$request->has('estado') OR $request->get('estado') == '')
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);

        $id = $request->get('id');
        $estado = $request->get('estado');

        $dia = ProgramadorEscenario::where(['id' => $id]);

        if (count($dia->get()->toArray()) != 1)
            return response()->json(['respuesta' => 'Not fount', 'status' => 404], 404);

        return $dia->update(['estado' => $estado]) ?
            response()->json([
                'respuesta' => 'Información guardada',
                'status' => 200,
                'data' => []], 200)
            : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
    }

}
