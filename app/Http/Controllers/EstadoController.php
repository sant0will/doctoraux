<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Estado;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::all();
        return view('estados.index',['estados' => $estados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estados.create');
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
            'nome' => 'required|unique:estados',
            'uf' => 'required|unique:estados|min:2|max:2',
        ]);

        //dd($v->errors());
    
        if ($v->fails())
        {
            return redirect()->back()->with('message', 'Estado já cadastrado');
        }

        $estado = new Estado;
        $estado->nome = $request->nome;
        $estado->uf = strtoupper($request->uf);

        if($estado->save()){
            return redirect('estados')->with('success', 'Estado cadastrado com sucesso');
        }else{
            return redirect('estados')->with('error', 'Falha ao cadastrar o estado');
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
        $estado = Estado::find($id);    
        return view('estados/edit', compact('estado','id'));
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
            'nome' => 'required|unique:estados',
            'uf' => 'required|unique:estados|min:2|max:2',
        ]);

        $estado = Estado::find($id);
        $estado->nome = $request->nome;
        $estado->uf = strtoupper($request->uf);

        if($estado->update()){
            return redirect('estados')->with('success', 'Estado editado com sucesso');
        }else{
            return redirect('estados')->with('error', 'Falha ao editar o estado');
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
        $estado = Estado::find($id);

        if($estado->delete()){
            return redirect('estados')->with('success', 'Estado excluído com sucesso');
        }else{
            return redirect('estados')->with('error', 'Falha ao excluir o estado');
        }  
    }
}
