<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EnderecoTemp
 * 
 * @property int $id
 * @property string $numero
 * @property string $cep
 * @property string $complemento
 * @property string $estado
 * @property string $cidade
 * @property string $bairro
 * @property string $logradouro
 * @property string $key_session
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class EnderecoTemp extends Eloquent
{
	protected $fillable = [
		'numero',
		'cep',
		'complemento',
		'estado',
		'cidade',
		'bairro',
		'logradouro',
		'key_session'
	];
}
