<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Exception;


use App\Models\Cidade;
use App\Models\Estado;

use App\Services\ConvertTime;

class ProfileController extends Controller
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
        return view('/cidadaos/create', compact('cidades', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->cpf == null){
            $v = Validator::make($request->all(), [
                // cidadao
                'TypePessoa' => 'required|max:1',
                'nome' => 'required|string|min:7|max:50',
                'cnpj' => 'required',
                'email' => 'required|string|email|min:7|max:50|unique:cidadaos',
                'telefone1' => 'required|string|min:10|max:15',
                'telefone2' => 'nullable|string|min:10|max:15',
                'horas' => 'required',
                'inscricao' => 'required',
            ]);
            $cpfcnpj = $request->cnpj;
        }else if($request->cnpj == null){
            $v = Validator::make($request->all(), [
                // cidadao
                'TypePessoa' => 'required|max:1',
                'nome' => 'required|string|min:7|max:50',
                'cpf' => 'required',
                'email' => 'required|string|email|min:7|max:50|unique:cidadaos',
                'telefone1' => 'required|string|min:10|max:15',
                'telefone2' => 'nullable|string|min:10|max:15',
                'horas' => 'required',
                'inscricao' => 'required',
            ]);
            $cpfcnpj = $request->cpf;
        }        
        
        if($v->fails()){
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }

        $segundos = ConvertTime::convertToSec($request->horas);
        
        $cidadao = new Cidadao;
        $cidadao->nome = $request->nome;
        $cidadao->Type = $request->TypePessoa;
        $cidadao->cpfcnpj = $cpfcnpj;
        $cidadao->email = $request->email;
        $cidadao->telefone1 = $request->telefone1;
        $cidadao->telefone2 = $request->telefone2;
        $cidadao->horas_servico = $segundos;
        $cidadao->inscricao_prod_rural = $request->inscricao;
        
        if($cidadao->save()){
            $enderecost = EnderecoTemp::where('key_session', $request->_token)->get();
            foreach($enderecost as $enderecot){
                $endereco = new Endereco();
                $endereco->cep = $enderecot->cep;
                $endereco->estado = $enderecot->estado;
                $endereco->cidade = $enderecot->cidade;
                $endereco->bairro = $enderecot->bairro;
                $endereco->logradouro = $enderecot->logradouro;
                $endereco->numero = $enderecot->numero;
                $endereco->complemento = $enderecot->complemento;
                $endereco->cidadao_id = $cidadao->id;
                $endereco->save();
                $enderecot->delete();
            }
            return redirect('/cidadaos')->with('success', 'Cidadão Cadastrado com sucesso');
        }else{
            return back()->with('message', 'Falha ao cadastrar usuário!');
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
        $cidadao = Cidadao::find($id);
        $user = User::where('cidadao_id', $id)->first();
        $user == null ? $user_id = null : $user_id = $user->id;
        $horasServico = ConvertTime::convertToTime($cidadao->horas_servico);
        $enderecos = Endereco::where('cidadao_id', $id)->get();
        return view('/cidadaos/show', compact('cidadao', 'enderecos', 'id', 'horasServico', 'user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cidadao = Cidadao::find($id);        
        $enderecos = Endereco::where('cidadao_id', $id)->get();
        $cidades = Cidade::orderBy('nome', 'asc')->get();
        $estados = Estado::orderBy('nome', 'asc')->get();
        $bairros = Bairro::orderBy('nome', 'asc')->get();

        return view('/cidadaos/edit', compact('cidadao', 'enderecos', 'cidades', 'estados', 'bairros'));
        
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
            // cidadao
            'nome' => 'required|string|min:4|max:50|unique:cidadaos,nome,'.$id,
            'email' => 'required|string|email|min:7|max:50|unique:cidadaos,email,'.$id,
            'telefone1' => 'required|string|min:10|max:15',
            'telefone2' => 'nullable|string|min:10|max:15',
        ]);
             
        if($v->fails()){
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }
        
        $cidadao = Cidadao::find($id);
        $cidadao->nome = $request->nome;
        $cidadao->email = $request->email;
        $cidadao->telefone1 = $request->telefone1;
        $cidadao->telefone2 = $request->telefone2;
        
        if($cidadao->update()){
            return redirect("/cidadaos/{$cidadao->id}/edit")->with('success', 'Cidadão editado com sucesso');
        }
        return redirect('/cidadaos')->with('error', 'Falha ao editar o cidadão');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $cidadao = Cidadao::find($id);

        if($cidadao->delete()){
            return redirect('/cidadaos')->with('success', 'Cidadão excluído com sucesso');
        }else{
            return redirect('/cidadaos')->with('error', 'Falha ao excluir o cidadão');
        }
    }
}