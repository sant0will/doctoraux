<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 18 May 2018 13:11:14 +0000.
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
 * @property \Illuminate\Database\Eloquent\Collection $bairros
 * @property \Illuminate\Database\Eloquent\Collection $logradouros
 *
 * @package App\Models
 */
class Cidade extends Eloquent
{
	protected $fillable = [
		'nome',
		'uf'
	];

	public function bairros()
	{
		return $this->hasMany(\App\Models\Bairro::class);
	}

	public function logradouros()
	{
		return $this->hasMany(\App\Models\Logradouro::class);
	}
}
