<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Parametro
 * 
 * @property int $id
 * @property string $parametro
 * @property string $descricao
 * @property string $valor
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Parametro extends Eloquent
{
	protected $fillable = [
		'parametro',
		'descricao',
		'valor'
	];
}
