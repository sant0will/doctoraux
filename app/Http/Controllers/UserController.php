<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;

use App\User;
use App\Models\Type;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Specialty;

use App\Services\RandomPass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $types = Type::all();
        return view('/users/index',['users' => $users, 'types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('users.create',['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            // user
            'type' => 'required|integer|not_in:--- Escolha um Type ---',
            'name' => 'required|string|min:4|max:50|unique:users',
            'email' => 'required|string|email|min:7|max:50|unique:users',
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }

        $pass = RandomPass::random_str(6);
        
        $user = new user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($pass);
        $user->access = false;
        $user->type_id = $request->type;
        $user_id = $user->id;
        $user_type = $user->type_id;
        $cidades = Cidade::orderBy('nome', 'asc')->get();
        $estados = Estado::orderBy('nome', 'asc')->get();
        $especialidades = Specialty::all();

        if($user->save()){
            return view('/profiles/create', compact('user_id', 'user_type' ,'cidades', 'estados', 'especialidades'))->with('success', 'Usuário cadastrado! Complete o cadastro de perfil.');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); 
        $types = Type::all();
        return view('users/show', compact('user','id', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id); 
        $types = Type::all();
        return view('users/edit', compact('user','id', 'types'));
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
            'type' => 'required|integer|not_in:--- Escolha um Type ---',
            'name' => 'required|string|min:4|max:50|unique:users,name,'.$id,
            'email' => 'required|string|email|min:7|max:50|unique:users,email,'.$id,
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v);
        }
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type_id = $request->type;
        if($user->update()){
            return redirect('/users')->with('success','Alteração realizada com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    /**
     * Reset the password of the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset($id)
    {
        //dd('reset: '.$id);
        $pass = RandomPass::random_str(6);

        $user = User::find($id);
        $user->password = Hash::make($pass);
        $user->access = false;
        if($user->update()){
            return redirect('/users')->with(['success' => 'Senha resetada com sucesso!', 'name' => $user->name, 'email' => $user->email, 'pass' => $pass]);
        } else {
            return back()->with('message', 'Falha no processo!');
        }
    }

    public function changepassword(){
        return view('/users/change');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->delete()){
            return redirect('users')->with('success', 'Exclusão realizada com sucesso!');
        }else{
            return redirect('users')->with('error', 'Falha na exclusão!');
        }  
    }
}
