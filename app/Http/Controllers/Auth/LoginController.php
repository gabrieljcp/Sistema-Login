<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
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

    public function loginAPI(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Erro' => $validator->errors()], 422);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            $randomBytes  = openssl_random_pseudo_bytes(40);
            $token = bin2hex($randomBytes);

            return response()->json([
                'Sucesso' => 'Login efetuado com sucesso!',
                'token' => $token,
            ]);
        } else {
            return response()->json(['Erro' => 'As credenciais não correspondem com nossos registros.'], 401);
        } 
    }


    public function logoutAPI(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response('Logout efetuado com sucesso');
        } else {
            return response('Nenhum usuário autenticado.', 401);
        }
    }

    public function registerAPI(Request $request)
    {
        User::updateOrInsert(['email' => $request->email], [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);

        return response('Cadastro efetuado com sucesso');
    }
}
