<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Cidade;
use App\Models\Estado;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = Cidade::orderBy('uf', 'asc')->get();
        return view('cidades.index',['cidades' => $cidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();
        return view('cidades.create',['estados' => $estados]);
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
            // cidades
            'nome' => 'required',
            'uf' => 'required|min:2|max:2',
        ]);
        

        $cidades = Cidade::all();
        foreach($cidades as $cidade){
            if($cidade->nome == $request->nome and $cidade->uf == $request->uf){    
                return redirect('cidades')->with('error', 'Cidade já cadastrada');
            }
        }

        $cidade = new Cidade;
        $cidade->nome = $request->nome;
        $cidade->uf = strtoupper($request->uf);

        if($cidade->save()){
            return redirect('cidades')->with('success', 'Cidade cadastrada com sucesso');
        }else{
            return redirect('cidades')->with('error', 'Falha ao cadastrar a cidade');
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
        $estados = Estado::all();
        $cidade = Cidade::find($id);    
        return view('cidades.edit',['cidade' => $cidade, 'estados' => $estados]);
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
            // cidades
            'nome' => 'required',
            'uf' => 'required|min:2|max:2',
        ]);

        $cidades = Cidade::all();
        foreach($cidades as $cidade){
            if($cidade->nome == $request->nome and $cidade->uf == $request->uf){                 
                return redirect('cidades')->with('error', 'Cidade já cadastrada');

            }       
        }
        
        $cidade = Cidade::find($id);
        $cidade->nome = $request->nome;
        $cidade->uf = strtoupper($request->uf);

        if($cidade->update()){
            return redirect('cidades')->with('success', 'Cidade editada com sucesso');
        }else{
            return redirect('cidades')->with('error', 'Falha ao editar a cidade');
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
        $cidade = Cidade::find($id);

        if($cidade->delete()){
            return redirect('cidades')->with('success', 'Cidade excluída com sucesso');
        }else{
            return redirect('cidades')->with('error', 'Falha ao excluir a cidade');
        }  
    }
}
