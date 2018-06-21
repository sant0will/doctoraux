<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\Profile;
use App\Models\Address;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Doctor;
use App\Models\Atendent;
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
        
        $v = Validator::make($request->all(), [
            'id' => 'required|integer',
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
            "especialidade" => 'required|not_in:--- Selecione a especialidade ---',
            'cpf' => 'required|string|max:14',
            'birth' => 'required|string|max:10',
            'email' => 'required|string|max:90',
            'phone2' => 'nullable|string|max:20',
        ]);
        

        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }

        $user = User::find($request->id);
        
        $address = new Address;
        $address->cep = $request->cep;
        $address->state_id = $request->estado;
        $address->city_id = $request->cidade;
        $address->neighborhood = $request->bairro;
        $address->street = $request->logradouro;
        $address->number = $request->numero;
        $address->complement = $request->complemento;
        if($address->save()){
            $profile = new Profile;
            $profile->name = $request->name;
            $profile->phone = $request->phone;
            $profile->gender = $request->sexo;
            $profile->user_id = $request->id;
            $profile->address_id = $address->id;
            if($profile->save()){
                if($request->tipo == 2){
                    $doctor = new Doctor;
                    $doctor->birth = $request->birth;
                    $doctor->cpf = $request->cpf;
                    $doctor->crm = $request->crm;
                    $doctor->email = $request->email;
                    $doctor->phone2	= $request->phone2;
                    $doctor->profile_id	 = $profile->id;
                    $doctor->specialty_id = $request->especialidade;
                    if($doctor->save()){
                       // dd($user);
                        return redirect('/users')->with('success', 'Cadastro de Médico realizado com sucesso!', 'user', $user);
                    }else{
                        return back()->with('error', 'Erro ao cadastrar o perfil');
                    }
                }else if($request->tipo == 2){
                    $atendente = new Atendet;
                    $atendente->birth = $request->birth;
                    $atendente->cpf = $request->cpf;
                    $atendente->pis = $request->pis;
                    $atendente->email = $request->email;
                    $atendente->phone2	= $request->phone2;
                    $atendente->profile_id	 = $profile->id;
                    if($atendente->save()){
                        return redirect('/users')->with('success', 'Cadastro de Atendente realizado com sucesso!', 'user', $user);
                    }else{
                        return back()->with('error', 'Erro ao cadastrar o perfil');
                    }
                }
            }else{
                return back()->with('error', 'Falha ao cadastrar o perfil!')->withInput();  
            }
        }else{
            return back()->with('error', 'Falha ao cadastrar endereço!')->withInput();
        }
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
