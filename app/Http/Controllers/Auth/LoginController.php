<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    // Redidereccion despues de iniciar sesión
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'user';
    }

    // Validar que el usuario este activo para inicair sesión 
    public function login(\Illuminate\Http\Request $request) {
        $this->validateLogin($request);
    
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
    
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
    
            // Asegúrar de que el usuario esté activo
            if ($user->estado && $this->attemptLogin($request)) {
                // Enviar la respuesta de inicio de sesión exitosa
                
                //ajuste de loguin para recibir peticiones AJAX
                if(request()->ajax()){
                    $resultLogin = $this->sendLoginResponse($request);
                    $respuesta = array(
                                        "response" => "OK"
                                        );
                    // dd($this->sendLoginResponse($request));
                    return response()->json($respuesta);
                }else{
                    return $this->sendLoginResponse($request);
                }
                
            } else {
                // Increment the failed login attempts and redirect back to the
                // formulario de inicio de sesión con un mensaje de error.
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors ([$this->username()=> 'Debe estar activo para iniciar sesión.']);
                    // return response()->json(['mensaje'=>'El usuario debe estar activo para iniciar sesión', 'code'=>1]);
            }
        }
    
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
    
        return $this->sendFailedLoginResponse($request);
    }
}
