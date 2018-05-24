<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logradouro;
use App\Models\TypeLogradouro;
use App\Models\Cidade;
use App\Models\Estado;
use Validator;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = Cidade::all();
        $logradouros = Logradouro::all();
        return view('logradouros.index',['logradouros' => $logradouros, 'cidades' => $cidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cidades = Cidade::all();
        $estados = Estado::all();
        $types = TypeLogradouro::all();
        return view('logradouros.create',['cidades' => $cidades, 'estados' => $estados, 'types' => $types]);
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
            // estados
            'estado' => 'required|not_in:--- Escolha um estado ---',
            'cidade' => 'required|not_in:--- Escolha uma cidade ---',
            'Type' => 'required|not_in:--- Escolha um Type ---',
            'logradouro' => 'required|min:2|max:100',
        ]);
    
        if ($v->fails())
        {
            return redirect()->back()->with('message', 'Logradouro já cadastrado');
        }
        
        $cidade_id = Cidade::where('nome', $request->cidade)->get();
        
        $logradouro = new Logradouro;
        $logradouro->Type = $request->Type;
        $logradouro->logradouro = $request->logradouro;
        $logradouro->cidade_id = $cidade_id[0]->id;

        if($logradouro->save()){
            return redirect('logradouros')->with('success', 'Logradouro cadastrado com sucesso');
        }else{
            return redirect('logradouros')->with('error', 'Falha ao cadastrar o logradouro');
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
        $logradouro = Logradouro::find($id);
        $cidade_id = Cidade::find($logradouro->cidade_id);
        $cidades = Cidade::all();
        $estados = Estado::all();
        $types = TypeLogradouro::all();
        return view('logradouros.edit',['cidades' => $cidades,'cidade_id' => $cidade_id, 'estados' => $estados, 'types' => $types, 'logradouro' => $logradouro]);
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
            // estados
            'estado' => 'required|not_in:--- Escolha um estado ---',
            'cidade' => 'required|not_in:--- Escolha uma cidade ---',
            'Type' => 'required|not_in:--- Escolha um Type ---',
            'logradouro' => 'required|min:2|max:100',
        ]);
        
        if ($v->fails())
        {
            return redirect()->back()->with('message', 'Logradouro já cadastrado');
        }

        $cidade_id = Cidade::where('nome', $request->cidade)->get();
        
        $logradouro = Logradouro::find($id);
        $logradouro->Type = $request->Type;
        $logradouro->logradouro = $request->logradouro;
        $logradouro->cidade_id = $cidade_id[0]->id;

        if($logradouro->save()){
            return redirect('logradouros')->with('success', 'Logradouro editado com sucesso');
        }else{
            return redirect('logradouros')->with('error', 'Falha ao editar o logradouro');
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
        $logradouro = Logradouro::find($id);

        if($logradouro->delete()){
            return redirect('logradouros')->with('success', 'Logradouro excluído com sucesso');
        }else{
            return redirect('logradouros')->with('error', 'Falha ao excluir o logradouro');
        }  
    }
}
