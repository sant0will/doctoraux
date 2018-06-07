<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 07 Jun 2018 12:04:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Doctor
 * 
 * @property int $id
 * @property string $birth
 * @property string $cpf
 * @property string $crm
 * @property string $email
 * @property string $phone2
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $profile_id
 * @property int $specialty_id
 * 
 * @property \App\Models\Profile $profile
 * @property \App\Models\Specialty $specialty
 *
 * @package App\Models
 */
class Doctor extends Eloquent
{
	protected $casts = [
		'profile_id' => 'int',
		'specialty_id' => 'int'
	];

	protected $fillable = [
		'birth',
		'cpf',
		'crm',
		'email',
		'phone2',
		'profile_id',
		'specialty_id'
	];

	public function profile()
	{
		return $this->belongsTo(\App\Models\Profile::class);
	}

	public function specialty()
	{
		return $this->belongsTo(\App\Models\Specialty::class);
	}
}
