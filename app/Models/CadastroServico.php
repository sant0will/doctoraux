<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 11 May 2018 22:48:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CadastroServico
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_agend_servicos
 * @property \Illuminate\Database\Eloquent\Collection $log_cancel_servicos
 * @property \Illuminate\Database\Eloquent\Collection $servico_ordem_servicos
 *
 * @package App\Models
 */
class CadastroServico extends Eloquent
{
	protected $fillable = [
		'descricao'
	];

	public function log_cancel_agend_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelAgendServico::class, 'servico_id');
	}

	public function log_cancel_servicos()
	{
		return $this->hasMany(\App\Models\LogCancelServico::class, 'servico_id');
	}

	public function servico_ordem_servicos()
	{
		return $this->hasMany(\App\Models\ServicoOrdemServico::class, 'servico_id');
	}
}
