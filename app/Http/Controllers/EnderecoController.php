<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\Cidadao;
use App\Models\Endereco;
use App\Models\EnderecoTemp;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Bairro;

class enderecoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}
        
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'cep' => 'required|string|min:8|max:9',
            'estado' => 'required|not_in:--- Escolha um estado ---',
            'cidade' => 'required|not_in:--- Escolha uma cidade ---',
            'bairro' => 'required|string|min:3|max:90',
            'logradouro' => 'required|string|min:3|max:90', 
            'numero' => 'required|string|max:6',
            'complemento' => 'nullable|string|max:90',
        ]);

        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }

        $endereco = new Endereco();
        $endereco->cep = $request->cep;
        $endereco->estado = $request->estado;
        $endereco->cidade = $request->cidade;
        $endereco->bairro = $request->bairro;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $endereco->cidadao_id = $request->cidadao_id;   
        
        if($endereco->save()){
            return redirect("/cidadaos/{$request->cidadao_id}/edit");
        }else{
            return back()->with('message', 'Falha ao armazenar endereço!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $endereco = Endereco::find($id);
        $cidades = Cidade::orderBy('nome', 'asc')->get();
        $estados = Estado::orderBy('nome', 'asc')->get();
        $bairros = Bairro::orderBy('nome', 'asc')->get();
        return view('/enderecos/edit',['cidades' => $cidades, 'estados' => $estados, 'bairros' => $bairros, 'endereco' => $endereco]);
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
            'cep' => 'required',
            'estado' => 'required|not_in:--- Escolha um estado ---',
            'cidade' => 'required|not_in:--- Escolha uma cidade ---',
            'bairro' => 'required',
            'logradouro' => 'required', 
            'numero' => 'required',
            'complemento' => 'nullable',
        ]);

        $endereco = Endereco::find($id);
        $endereco->cep = $request->cep;
        $endereco->estado = $request->estado;
        $endereco->cidade = $request->cidade;
        $endereco->bairro = $request->bairro;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;


        if($endereco->update()){
            return redirect("/cidadaos/create")->with('success', 'Endereço alterado com sucesso');
        }
        return redirect('/cidadaos/create')->with('error', 'Falha ao alterar o endereço');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $endereco = Endereco::where('id',$id)->first();

        if($endereco->delete()){
            return back()->with('success', ' Endereço excluído!');
        }else{
            return back()->with('message', 'Falha ao excluir endereço!');
        }
    }
}
