<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('guest')->except('logout');*/
    }

    public function login()
    {
        $credentials = $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required|string',
            
        ]);

        $credentials['tipo_usuario_id'] = 2;
            
        if (Auth::guard('web')->attempt($credentials))
        {
            return redirect()->route('index');
        }
        return back()
            ->withErrors(['email' => 'Estas credenciales no son validas'])
            ->withInput(request(['email']));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
