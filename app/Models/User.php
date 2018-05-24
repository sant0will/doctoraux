<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $access
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $cidadao_id
 * @property int $type_id
 * 
 * @property \App\Models\Cidadao $cidadao
 * @property \App\Models\Type $Type
 * @property \Illuminate\Database\Eloquent\Collection $execucao_servicos
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_agend_servicos
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_servicos
 * @property \Illuminate\Database\Eloquent\Collection $ordem_servicos
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $casts = [
		'access' => 'bool',
		'cidadao_id' => 'int',
		'type_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'access',
		'remember_token',
		'cidadao_id',
		'type_id'
	];

	public function cidadao()
	{
		return $this->belongsTo(\App\Models\Cidadao::class);
	}

	public function Type()
	{
		return $this->belongsTo(\App\Models\Type::class);
	}

	public function execucao_servicos()
	{
		return $this->hasMany(\App\Models\ExecucaoServico::class, 'usuario_id');
	}

	public function log_cancel_agend_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelAgendServico::class);
	}

	public function log_cancel_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelServico::class);
	}

	public function ordem_servicos()
	{
		return $this->hasMany(\App\Models\OrdemServico::class);
	}
}
