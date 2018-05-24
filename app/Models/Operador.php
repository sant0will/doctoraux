<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 18 May 2018 13:11:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Operador
 * 
 * @property int $id
 * @property string $codigo_operador
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $cidadao_id
 * 
 * @property \App\Models\Cidadao $cidadao
 *
 * @package App\Models
 */
class Operador extends Eloquent
{
	protected $casts = [
		'cidadao_id' => 'int'
	];

	protected $fillable = [
		'codigo_operador',
		'cidadao_id'
	];

	public function cidadao()
	{
		return $this->belongsTo(\App\Models\Cidadao::class);
	}
}
