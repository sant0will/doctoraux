<?php

namespace App\Http\Controllers;

use App\Models\CadastroServico;
use Illuminate\Http\Request;
use Validator;

class CadastroServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicos = CadastroServico::all();
        return view('/servicos/index',['servicos' => $servicos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicos = CadastroServico::all();
        return view('servicos.create',['servicos' => $servicos]);
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
            // servico
            'descricao' => 'required|string|min:3|max:45|unique:cadastro_servicos',
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }
        
        $servico = new CadastroServico;
        $servico->descricao = $request->descricao;
        if($servico->save()){
            return redirect('/servicos')->with('success','Cadastro realizado com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroServico  $cadastroServico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicos = CadastroServico::find($id);
        return view('servicos/show', compact('servicos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CadastroServico  $cadastroServico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servico = CadastroServico::find($id); 
        return view('servicos/edit', compact('servico','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CadastroServico  $cadastroServico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            // servico
            'descricao' => 'required|string|min:3|max:45|unique:cadastro_servicos,descricao,'.$id,
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }
        
        $servico = CadastroServico::find($id);
        $servico->descricao = $request->descricao;
        if($servico->update()){
            return redirect('/servicos')->with('success','Cadastro realizado com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastroServico  $cadastroServico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servico = CadastroServico::find($id);

        if($servico->delete()){
            return redirect('servicos')->with('success', 'Exclusão realizada com sucesso!');
        }else{
            return redirect('servicos')->with('error', 'Falha na exclusão!');
        }
    }
}
