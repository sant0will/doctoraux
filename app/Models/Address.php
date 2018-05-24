<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 May 2018 12:29:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Address
 * 
 * @property int $id
 * @property string $cep
 * @property string $neighborhood
 * @property string $street
 * @property string $number
 * @property string $complement
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $city_id
 * @property int $state_id
 * 
 * @property \App\Models\Cidade $cidade
 * @property \App\Models\Estado $estado
 * @property \Illuminate\Database\Eloquent\Collection $profiles
 *
 * @package App\Models
 */
class Address extends Eloquent
{
	protected $casts = [
		'city_id' => 'int',
		'state_id' => 'int'
	];

	protected $fillable = [
		'cep',
		'neighborhood',
		'street',
		'number',
		'complement',
		'city_id',
		'state_id'
	];

	public function cidade()
	{
		return $this->belongsTo(\App\Models\Cidade::class, 'city_id');
	}

	public function estado()
	{
		return $this->belongsTo(\App\Models\Estado::class, 'state_id');
	}

	public function profiles()
	{
		return $this->hasMany(\App\Models\Profile::class);
	}
}
