<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Meio
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ordem_servicos
 *
 * @package App\Models
 */
class Meio extends Eloquent
{
	protected $fillable = [
		'nome'
	];

	public function ordem_servicos()
	{
		return $this->hasMany(\App\Models\OrdemServico::class);
	}
}
