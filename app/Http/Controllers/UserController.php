<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $listaUsuarios = User::all();
    //     return view('users.list', ['listaUsuarios' => $listaUsuarios]);
    // }
    
    
    public function index()
    {
        $listaUsuarios = User::simplePaginate(5);
        $user_id = Auth::id();
        $usuarioAutenticado = User::where('id',$user_id)->with('follows')->first();
        return view('users.list', ['listaUsuarios' => $listaUsuarios, 
                                   'usuarioAutenticado' => $usuarioAutenticado]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id',$id)->with('posts', 
                                            'posts.comments', 
                                            'posts.comments.user', 
                                            'posts.likes', 
                                            'posts.likes.user', 
                                            'follows', 
                                            'followers')->first();
        $user_id = Auth::id();
        $usuarioAutenticado = User::where('id',$user_id)->with('follows')->first();
        return view('users.show', ['user' => $user,'usuarioAutenticado' => $usuarioAutenticado]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
