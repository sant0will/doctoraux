<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Setor
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ordem_servicos
 * @property \Illuminate\Database\Eloquent\Collection $sequencias
 *
 * @package App\Models
 */
class Setor extends Eloquent
{
	protected $fillable = [
		'nome'
	];

	public function ordem_servicos()
	{
		return $this->hasMany(\App\Models\OrdemServico::class);
	}

	public function sequencias()
	{
		return $this->hasMany(\App\Models\Sequencia::class);
	}
}
