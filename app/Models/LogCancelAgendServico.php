<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LogCancelAgendServico
 * 
 * @property int $id
 * @property string $justificativa
 * @property string $observacao
 * @property string $data_programacao
 * @property string $hora_programacao
 * @property string $maquinas
 * @property string $data_cancelamento
 * @property string $hora_cancelamento
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 * @property int $servico_id
 * @property int $ordemservico_id
 * @property int $servicoordemservico_id
 * 
 * @property \App\Models\OrdemServico $ordem_servico
 * @property \App\Models\CadastroServico $cadastro_servico
 * @property \App\Models\ServicoOrdemServico $servico_ordem_servico
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class LogCancelAgendServico extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'servico_id' => 'int',
		'ordemservico_id' => 'int',
		'servicoordemservico_id' => 'int'
	];

	protected $fillable = [
		'justificativa',
		'observacao',
		'data_programacao',
		'hora_programacao',
		'maquinas',
		'data_cancelamento',
		'hora_cancelamento',
		'user_id',
		'servico_id',
		'ordemservico_id',
		'servicoordemservico_id'
	];

	public function ordem_servico()
	{
		return $this->belongsTo(\App\Models\OrdemServico::class, 'ordemservico_id');
	}

	public function cadastro_servico()
	{
		return $this->belongsTo(\App\Models\CadastroServico::class, 'servico_id');
	}

	public function servico_ordem_servico()
	{
		return $this->belongsTo(\App\Models\ServicoOrdemServico::class, 'servicoordemservico_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
