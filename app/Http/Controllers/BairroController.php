<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Bairro;

class BairroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bairros = Bairro::all();
        return view('bairros.index',['bairros' => $bairros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bairros.create');
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
            // bairros
            'nome' => 'required|unique:bairros',
            'cidade_id' => 'required'
        ]);
        
        if($v->fails()){
            return redirect('bairros')->with('error', 'Bairro já cadastrado');
        }

        // $cidades = Cidade::all();
        // foreach($cidades as $cidade){
        //     if($cidade->id == $request->id_cidade*/){    
        //         
        //     }
        // }

        $bairro = new Bairro;
        $bairro->nome = $request->nome;
        $bairro->cidade_id = 4559 /*$request->id_cidade*/;

        if($bairro->save()){
            return redirect('bairros')->with('success', 'Bairro cadastrado com sucesso');
        }else{
            return redirect('bairros')->with('error', 'Falha ao cadastrar o bairro');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bairro = Bairro::find($id);    
        return view('bairros.edit',['bairro' => $bairro]);
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
            // bairros
            'nome' => 'required|unique:bairros',
            'cidade_id' => 'required'
        ]);
        
        if($v->fails()){
            return redirect('bairros')->with('error', 'Bairro já cadastrado');
        }

        // $cidades = Cidade::all();
        // foreach($cidades as $cidade){
        //     if($cidade->id == $request->id_cidade*/){    
        //         
        //     }
        // }

        $bairro = Bairro::find($id);
        $bairro->nome = $request->nome;
        $bairro->cidade_id = 4559 /*$request->id_cidade*/;

        if($bairro->save()){
            return redirect('bairros')->with('success', 'Bairro atualizado com sucesso');
        }else{
            return redirect('bairros')->with('error', 'Falha ao atualizar o bairro');
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
        $bairro = Bairro::find($id);

        if($bairro->delete()){
            return redirect('bairros')->with('success', 'Bairro excluído com sucesso');
        }else{
            return redirect('bairros')->with('error', 'Falha ao excluir o bairro');
        }  
    }
}
