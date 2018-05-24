<?php

namespace App\Http\Controllers;

use App\Models\Operador;
use App\Models\Cidadao;
use Illuminate\Http\Request;
use Validator;

class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operadores = Operador::all();
        $cidadaos = Cidadao::all();
        return view('/operadores/index',['operadores' => $operadores, 'cidadaos' => $cidadaos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cidadaos = Cidadao::all();
        return view('operadores.create',['cidadaos' => $cidadaos]);
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
            // operador
            'codigo_operador' => 'required|string|min:1|max:45|unique:operadors',
            'cidadao' => 'required|integer|not_in:--- Escolha um cidadão ---',
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }
        
        $operador = new Operador;
        $operador->codigo_operador = $request->codigo_operador;
        $operador->cidadao_id = $request->cidadao;
        if($operador->save()){
            return redirect('/operadores')->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operador = Operador::find($id);
        $cidadaos = Cidadao::all();
        return view('operadores/edit', compact('operador', 'id', 'cidadaos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            // operador
            'codigo_operador' => 'required|string|min:1|max:45|unique:operadors',
            'cidadao' => 'required|integer|not_in:--- Escolha um cidadão ---',
        ]);
        
        if($v->fails()) {
            return back()->with('message', 'Confira os dados informados!')->withErrors($v)->withInput();
        }
        
        $operador = Operador::find($id);
        $operador->codigo_operador = $request->codigo_operador;
        $operador->cidadao_id = $request->cidadao;
        if($operador->save()){
            return redirect('/operadores')->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return back()->with('message', 'Falha no cadastro!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operador  $operador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operador = Operador::find($id);

        if($operador->delete()){
            return redirect('operadores')->with('success', 'Exclusão realizada com sucesso!');
        }else{
            return redirect('operadores')->with('error', 'Falha na exclusão!');
        }
    }
}
