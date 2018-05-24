<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CadastroMaquina
 * 
 * @property int $id
 * @property string $descricao
 * @property string $codigo_frota
 * @property float $valor
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class CadastroMaquina extends Eloquent
{
	protected $casts = [
		'valor' => 'float'
	];

	protected $fillable = [
		'descricao',
		'codigo_frota',
		'valor'
	];
}
