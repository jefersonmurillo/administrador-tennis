<?php

namespace App\Http\Controllers\Services;

use App\Models\Disciplina;
use App\Models\Evento;
use App\Models\Instalacion;
use App\Models\ProgramadorEscenario;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Services extends Controller
{

    /* *************************************** INSTALACIONES ****************************************/

    public function obtenerInstalaciones()
    {
        return response()->json([
            'status' => 'ok',
            'data' => Instalacion::with(['disciplina', 'tipoInstalacion', 'imagenesInstalacions'])->get()->toArray(),
            'message' => 'Consulta Exitosa'
        ]);
    }

    public function obtenerTipoInstalacion()
    {
        return response()->json(Disciplina::with([''])->get()->toArray());
    }

    /* *************************************** EVENTOS ************************************/

    public function obtenerEventos()
    {
        $eventos = Evento::with(['prioridad', 'tipoEvento', 'imagenesEventos'])->get()->toArray();
        $data = [];

        /**
         * Cambio el formado de la fecha ejemplo: Jul. 31 2019
         */
        foreach ($eventos as $evento) {
            $evento['fecha_inicio'] = date("M. j Y", strtotime($evento['fecha_inicio']));
            $evento['fecha_fin'] = date("M. j Y", strtotime($evento['fecha_fin']));
            array_push($data, $evento);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $data,
            'message' => 'Consulta Exitosa'
        ]);
    }

    /* ************************************ TEE TIME ***********************************/

    public function obtenerJugadoresGolf(Request $request)
    {
        $codigos = $request->get('codigos');
        if (count($codigos) < 3)
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'Jugadores incompletos'
            ], 402);

        $data = [];

        foreach ($codigos as $codigo) {
            $jugador = User::where(['codigo_golfista' => $codigo, 'estado_users_id' => 1])->get()->toArray();
            if (count($jugador) < 1) {
                array_push($data, [
                    'status' => 'error',
                    'data' => [],
                    'message' => 'No se encontro el jugador'
                ]);
            } else {
                array_push($data, [
                    'status' => 'ok',
                    'data' => $jugador[0],
                    'message' => 'Consulta Exitosa'
                ]);
            }
        }

        return response()->json([
            'status' => 'ok',
            'data' => $data,
            'message' => 'Consulta Exitosa'
        ], 200);
    }

    public function obtenerDiasDisponibles()
    {
        $dias = ProgramadorEscenario::where('fecha', '>=', date('Y-m-d'))->groupBy('fecha')->get(['fecha'])->toArray();

        $programador = ProgramadorEscenario::where('fecha', '>=', date('Y-m-d'))
            ->orWhere('estado', ['DISPONIBLE', 'DESAPROBADO'])->orderBy('fecha', 'ASC')->orderBy('hora', 'ASC')
            ->with(['escenario.disciplina'])->get()->toArray();

        $data = [];

        foreach ($dias as $dia){
            $var = ['fecha' => $dia['fecha'], 'dias' => []];
            foreach ($programador as $p){
                if($p['fecha'] == $dia['fecha']){
                    array_push($var['dias'], $p);
                }
            }
            array_push($data, $var);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $data,
            'message' => 'Consulta Exitosa'
        ], 200);

    }

    /* ************************************ DISCIPLINAS ***********************************/

    public function obtenerDisciplinas()
    {
        return response()->json([
            'status' => 'ok',
            'data' => Disciplina::all()->toArray(),
            'message' => 'Consulta Exitosa'
        ], 200);
    }

}
