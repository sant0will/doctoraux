<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Hash;

class NewPassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('newpass.edit', compact('user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'password' => 'required|string|min:6|max:50',
            'password_confirmation' => 'same:password',
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v);
        }
        
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->access = true;
        if($user->update()){
            return redirect('/home')->with('success', 'Senha alterada com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    public function updatepassword(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'password' => 'required|string|min:6|max:50',
            'password_confirmation' => 'same:password',
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v);
        }
        
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->access = true;
        if($user->update()){
            return redirect('/home')->with('success', 'Senha alterada com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }
    
}
