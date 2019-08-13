<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
