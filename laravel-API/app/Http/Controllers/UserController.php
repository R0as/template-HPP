<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return Auth::user()->roles === 'admin' ? User::all() : response()->json(['error' => 'Acesso não autorizado.'], 403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request){
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json(['message' => 'Usuário criado com sucesso!', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return Auth::user()->roles === 'admin' ? $user : response()->json(['error' => 'Acesso não autorizado.'], 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
