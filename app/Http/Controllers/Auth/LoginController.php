<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){
        $user = User::where('email',$request->input('username'))->first();
        if(!isset($user)){
            return response('用户不存在',403);
        }
        $res = Hash::check($request->input('password'),isset($user)?$user->password:'');
        if($res)
        {
            session(['user' => $user->name]);
            session(['userId' => $user->id]);
            $password_client = Client::query()->where('password_client',1)->latest()->first();
            $request->request->add([
                'grant_type' => 'password',
                'client_id' => $password_client->id,
                'client_secret' => $password_client->secret,
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'scope' => '*',
            ]);
            $proxy = Request::create(
                'oauth/token',
                'POST'
            );
            $response = \Route::dispatch($proxy);
            return $response;
        }else{
            return response('密码错误',401);
        }


    }
}
