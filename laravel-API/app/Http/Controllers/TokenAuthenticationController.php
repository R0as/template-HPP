<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class TokenAuthenticationController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['As credenciais informadas estão incorretas.'],
            ]);
        }

        return [
            'token'=>$user->createToken('token-name')->plainTextToken
        ];  
    }

    public function destroy(Request $request){
        $request->user()->currentAccessToken()->delete();
    }
}
