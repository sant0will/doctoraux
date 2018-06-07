<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Profile;
use App\Models\Address;
use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = Cidade::orderBy('nome', 'asc')->get();
        $estados = Estado::orderBy('nome', 'asc')->get();
        return view('/profiles/index', compact( 'cidades', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cidades = Cidade::orderBy('nome', 'asc')->get();
        $estados = Estado::orderBy('nome', 'asc')->get();
        return view('/profiles/create', compact('cidades', 'estados'));
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            dd($request);
        $v = Validator::make($request->all(), [
            'name' => 'required|string|min:7|max:50',
            'phone' => 'required|string|min:10|max:15',
            'sexo' => 'required|max:1',
            'cep' => 'required|string|min:8|max:9',
            'estado' => 'required|not_in:--- Escolha um estado ---',
            'cidade' => 'required|not_in:--- Escolha uma cidade ---',
            'bairro' => 'required|string|min:3|max:90',
            'logradouro' => 'required|string|min:3|max:90', 
            'numero' => 'required|string|max:6',
            'complemento' => 'nullable|string|max:90',
            'crm' => 'required|string|max:7',
            'cpf' => 'required|string|max:14',
            'birth' => 'required|string|max:10',
            'email' => 'required|string|max:90',
            'phone2' => 'nullable|string|max:20',
        ]);
        

        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }

        
        //     dd($request);
        //     $address = new Address;
        //     $address->cep = $request->cep;
        //     $address->state_id = $request->estado;
        //     $address->city_id = $request->cidade;
        //     $address->neighborhood = $request->bairro;
        //     $address->street = $request->logradouro;
        //     $address->number = $request->numero;
        //     $address->complement = $request->complemento;
        //     $address->save()

        //     $profile = new Profile;
        //     $profile->name = $request->name;
        //     $profile->phone = $request->phone;
        //     $profile->gender = $request->sexo;
        //     $profile->user_id = $request->id;
        //     $profile->address_id = $address->id;
        //     $profile->save()




                    
               
        //     return redirect('/profiles')->with(['success' => 'Cadastro realizado com sucesso!', 'name' => $user->name, 'email' => $user->email, 'pass' => $pass, 'id' => $user->id]);
        // }catch(){
        //     return back()->with('error', 'Erro ao cadastrar o perfil');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
