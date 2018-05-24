<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 18 May 2018 13:11:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bairro
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $cidade_id
 * 
 * @property \App\Models\Cidade $cidade
 *
 * @package App\Models
 */
class Bairro extends Eloquent
{
	protected $casts = [
		'cidade_id' => 'int'
	];

	protected $fillable = [
		'nome',
		'cidade_id'
	];

	public function cidade()
	{
		return $this->belongsTo(\App\Models\Cidade::class);
	}
}
