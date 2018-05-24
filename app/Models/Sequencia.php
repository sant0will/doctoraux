<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Sequencia
 * 
 * @property int $id
 * @property int $sequencia
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $setor_id
 * 
 * @property \App\Models\Setor $setor
 *
 * @package App\Models
 */
class Sequencia extends Eloquent
{
	protected $casts = [
		'sequencia' => 'int',
		'setor_id' => 'int'
	];

	protected $fillable = [
		'sequencia',
		'setor_id'
	];

	public function setor()
	{
		return $this->belongsTo(\App\Models\Setor::class);
	}
}
