<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 18 May 2018 13:11:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Endereco
 * 
 * @property int $id
 * @property string $numero
 * @property string $cep
 * @property string $complemento
 * @property string $estado
 * @property string $cidade
 * @property string $bairro
 * @property string $logradouro
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $cidadao_id
 * 
 * @property \App\Models\Cidadao $cidadao
 *
 * @package App\Models
 */
class Endereco extends Eloquent
{
	protected $casts = [
		'cidadao_id' => 'int'
	];

	protected $fillable = [
		'numero',
		'cep',
		'complemento',
		'estado',
		'cidade',
		'bairro',
		'logradouro',
		'cidadao_id'
	];

	public function cidadao()
	{
		return $this->belongsTo(\App\Models\Cidadao::class);
	}
}
