<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest');
    }*/

    /**
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function cambiarContrasenia(Request $request){

        if($request->input('password') != $request->input('password_confirmation'))
            return redirect()->back()->withErrors(['password' => 'Diferentes']);

        $usuario = User::where(['email' => $request->input('email')]);

        if(count($usuario->get()->toArray()) == 0)
            return redirect()->back()->withErrors(['email' => 'No existe'] );

        if($usuario->update(['password' =>  Hash::make($request->input('password'))]))
            return redirect()->back()->withErrors(['status' => 'error'] );
        else return redirect()->back()->withErrors(['status' => 'ok']);
    }
}
