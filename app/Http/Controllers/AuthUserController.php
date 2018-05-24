<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Type;

class AuthUserController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $Type = Type::find($user->type_id)->nome;
        return view('user/edit', compact('user', 'Type'));
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
            // user
            'name' => 'required|string|min:4|max:50|unique:users,name,'.$id,
            'email' => 'required|string|email|min:7|max:50|unique:users,email,'.$id,
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v);
        }
        
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if($user->update()){
            return redirect('/usuario/infos')->with('success','Alteração realizada com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
