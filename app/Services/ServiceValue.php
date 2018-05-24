<?php

namespace App\Services;

use App\Models\CadastroMaquina;

class ServiceValue{

    public static function horaMaquina($inicial, $final, $id)
    {      
        $horas = $final - $inicial;
        $valor = CadastroMaquina::find($id)->value('valor');

        return $horas * $valor;
    }

    public static function totalServico($inicial, $final, $maquinasServico)
    {      
        $idmaquinas = explode(',', $maquinasServico);
        $valor = 0;

        foreach($idmaquinas as $idmaquina){
            $valor += Servicevalue::horaMaquina($inicial, $final, $idmaquina);
        }

        return $valor;
    }

}