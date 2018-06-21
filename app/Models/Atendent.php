<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 07 Jun 2018 22:56:38 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Atendent
 * 
 * @property int $id
 * @property string $birth
 * @property string $pis
 * @property string $cpf
 * @property string $email
 * @property string $phone2
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $profile_id
 * 
 * @property \App\Models\Profile $profile
 *
 * @package App\Models
 */
class Atendent extends Eloquent
{
	protected $casts = [
		'profile_id' => 'int'
	];

	protected $fillable = [
		'birth',
		'pis',
		'cpf',
		'email',
		'phone2',
		'profile_id'
	];

	public function profile()
	{
		return $this->belongsTo(\App\Models\Profile::class);
	}
}
