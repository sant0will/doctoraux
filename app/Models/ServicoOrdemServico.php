<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ServicoOrdemServico
 * 
 * @property int $id
 * @property string $observacao
 * @property int $status
 * @property string $data_programacao
 * @property string $hora_programacao
 * @property string $maquinas
 * @property bool $agendado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $servico_id
 * @property int $ordemservico_id
 * 
 * @property \App\Models\OrdemServico $ordem_servico
 * @property \App\Models\CadastroServico $cadastro_servico
 * @property \Illuminate\Database\Eloquent\Collection $execucao_servicos
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_agend_servicos
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_servicos
 *
 * @package App\Models
 */
class ServicoOrdemServico extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'agendado' => 'bool',
		'servico_id' => 'int',
		'ordemservico_id' => 'int'
	];

	protected $fillable = [
		'observacao',
		'status',
		'data_programacao',
		'hora_programacao',
		'maquinas',
		'agendado',
		'servico_id',
		'ordemservico_id'
	];

	public function ordem_servico()
	{
		return $this->belongsTo(\App\Models\OrdemServico::class, 'ordemservico_id');
	}

	public function cadastro_servico()
	{
		return $this->belongsTo(\App\Models\CadastroServico::class, 'servico_id');
	}

	public function execucao_servicos()
	{
		return $this->hasMany(\App\Models\ExecucaoServico::class, 'servicoordemservico_id');
	}

	public function log_cancel_agend_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelAgendServico::class, 'servicoordemservico_id');
	}

	public function log_cancel_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelServico::class, 'servicoordemservico_id');
	}
}
