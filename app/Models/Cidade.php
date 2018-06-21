<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 07 Jun 2018 22:56:38 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cidade
 * 
 * @property int $id
 * @property string $nome
 * @property string $uf
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 *
 * @package App\Models
 */
class Cidade extends Eloquent
{
	protected $fillable = [
		'nome',
		'uf'
	];

	public function addresses()
	{
		return $this->hasMany(\App\Models\Address::class, 'city_id');
	}
}
