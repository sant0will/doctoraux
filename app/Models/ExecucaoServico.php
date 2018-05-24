<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ExecucaoServico
 * 
 * @property int $id
 * @property string $data_inicial
 * @property string $data_final
 * @property string $hora_inicio
 * @property string $hora_fim
 * @property string $horimetro_inicio
 * @property string $horimetro_fim
 * @property string $operadores
 * @property string $maquinas
 * @property float $valor
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $usuario_id
 * @property int $servicoordemservico_id
 * 
 * @property \App\Models\ServicoOrdemServico $servico_ordem_servico
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class ExecucaoServico extends Eloquent
{
	protected $casts = [
		'valor' => 'float',
		'usuario_id' => 'int',
		'servicoordemservico_id' => 'int'
	];

	protected $fillable = [
		'data_inicial',
		'data_final',
		'hora_inicio',
		'hora_fim',
		'horimetro_inicio',
		'horimetro_fim',
		'operadores',
		'maquinas',
		'valor',
		'usuario_id',
		'servicoordemservico_id'
	];

	public function servico_ordem_servico()
	{
		return $this->belongsTo(\App\Models\ServicoOrdemServico::class, 'servicoordemservico_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'usuario_id');
	}
}
