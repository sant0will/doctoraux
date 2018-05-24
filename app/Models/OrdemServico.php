<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrdemServico
 * 
 * @property int $id
 * @property string $data_abertura
 * @property string $data_encerramento
 * @property int $numero_ordem
 * @property int $status
 * @property string $observacao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $setor_id
 * @property int $meio_id
 * @property int $cidadao_id
 * @property int $user_id
 * 
 * @property \App\Models\Cidadao $cidadao
 * @property \App\Models\Meio $meio
 * @property \App\Models\Setor $setor
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_agend_servicos
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_servicos
 * @property \Illuminate\Database\Eloquent\Collection $servico_ordem_servicos
 *
 * @package App\Models
 */
class OrdemServico extends Eloquent
{
	protected $casts = [
		'numero_ordem' => 'int',
		'status' => 'int',
		'setor_id' => 'int',
		'meio_id' => 'int',
		'cidadao_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'data_abertura',
		'data_encerramento',
		'numero_ordem',
		'status',
		'observacao',
		'setor_id',
		'meio_id',
		'cidadao_id',
		'user_id'
	];

	public function cidadao()
	{
		return $this->belongsTo(\App\Models\Cidadao::class);
	}

	public function meio()
	{
		return $this->belongsTo(\App\Models\Meio::class);
	}

	public function setor()
	{
		return $this->belongsTo(\App\Models\Setor::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function log_cancel_agend_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelAgendServico::class, 'ordemservico_id');
	}

	public function log_cancel_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelServico::class, 'ordemservico_id');
	}

	public function servico_ordem_servicos()
	{
		return $this->hasMany(\App\Models\ServicoOrdemServico::class, 'ordemservico_id');
	}
}
