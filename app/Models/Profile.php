<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 07 Jun 2018 12:04:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Profile
 * 
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $gender
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 * @property int $address_id
 * 
 * @property \App\Models\Address $address
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $doctors
 *
 * @package App\Models
 */
class Profile extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'address_id' => 'int'
	];

	protected $fillable = [
		'name',
		'phone',
		'gender',
		'user_id',
		'address_id'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function doctors()
	{
		return $this->hasMany(\App\Models\Doctor::class);
	}
}
