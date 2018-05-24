<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 18 May 2018 13:11:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cidadao
 * 
 * @property int $id
 * @property string $cpfcnpj
 * @property int $Type
 * @property string $nome
 * @property string $email
 * @property string $telefone1
 * @property string $telefone2
 * @property int $horas_servico
 * @property string $inscricao_prod_rural
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $enderecos
 * @property \Illuminate\Database\Eloquent\Collection $operadors
 *
 * @package App\Models
 */
class Cidadao extends Eloquent
{
	protected $casts = [
		'Type' => 'int',
		'horas_servico' => 'int'
	];

	protected $fillable = [
		'cpfcnpj',
		'Type',
		'nome',
		'email',
		'telefone1',
		'telefone2',
		'horas_servico',
		'inscricao_prod_rural'
	];

	public function enderecos()
	{
		return $this->hasMany(\App\Models\Endereco::class);
	}

	public function operadors()
	{
		return $this->hasMany(\App\Models\Operador::class);
	}
}
