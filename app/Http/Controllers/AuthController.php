<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use JWTAuth;
use App\Log;
use Carbon\Carbon;

class AuthController extends Controller
{
    use SharedController;
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginOrigin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public  function  login(Request  $request)
    {
        $this->permission = $this->permission($request);
        if($this->permission->suspended==='0'){
            //
            $input = $request->only('email', 'password');
            $jwt_token = null;
            $user = Auth::user(); 

            if (!$jwt_token = JWTAuth::attempt($input)) {
                $formData = [
                    'user_id' => 0,
                    'event' => 'Login failed ' . $request->email
                ];
                $log = new Log();
                $log->fill($formData)->save();
                //
                $this->loadData = 1;
                $this->error = 1;
                $this->message = 'Error: Correo o Contraseña invalido.';
                $this->data = [];
                //
            } 
            else {
                if( Auth::user()->active === '0' ){
                    //
                    $formData = [
                        'user_id' => 0,
                        'event' => 'Login disabled ' . $request->email
                    ];
                    $log = new Log();
                    $log->fill($formData)->save();
                    //
                    $this->loadData = 1;
                    $this->error = 1;
                    $this->message = 'Error: Usuario no habilitado';
                    $this->data = [];
                    //
                    };
                if( Auth::user()->active === '1' ){
                    $formData = [
                        'user_id' => Auth::user()->id,
                        'event' => 'Login success'
                    ];
                    $log = new Log();
                    $log->fill($formData)->save();
                    //
                    $this->loadData = 1;
                    $this->error = 0;
                    $this->message = 'Acceso Permitido... Entrando al sistema !!';
                    $this->data = 
                    [
                        'sysName' => Auth::user()->sysname,
                        'name' => Auth::user()->firstname . ' ' .
                                Auth::user()->midname . ' ' .
                                Auth::user()->lastname,
                        'userId' => Auth::user()->id,
                        // 'active' => Auth::user()->active ,
                        'movil' => Auth::user()->movil ,
                        'email' => Auth::user()->email ,
                        'dateStrNow' => $this->dateStr(),
                        'loginTime' => $this->loginTime(),
                        // 'user' => Auth::user(),
                        'token' => $jwt_token
                    ];

                    //
            };
            };

        };
        $response = array();
        $response['loadData'] = $this->loadData;
        $response['error'] = $this->error;
        $response['message'] = $this->message;
        $response['data'] = $this->data;
        return $response;
    }
    public function dateStr() 
    {
        setlocale(LC_TIME, 'es_MX', 'Spanish_Spain', 'Spanish'); 
        date_default_timezone_set("America/Mexico_City");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse(Carbon::now());
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y'); // . ' Hora ' . $fecha->format('h:i:s A');
    }
    public function loginTime()
    {
        setlocale(LC_TIME, 'es_MX', 'Spanish_Spain', 'Spanish'); 
        date_default_timezone_set("America/Mexico_City");
        $fecha = Carbon::parse(Carbon::now());
        return $fecha->format('h:i:s A');
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
