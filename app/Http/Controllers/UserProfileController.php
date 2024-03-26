<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('perfil/perfil');
    }

    public function perfil(Request $request)
    {
        $dados = User::where('email',$request->email)->get();
        
        if($dados->isnotempty()) {
            return response($dados);
        } else {
            return response ("Usuario não encontrado");
        }
    }
}
