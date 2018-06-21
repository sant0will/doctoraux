<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 07 Jun 2018 22:56:38 +0000.
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
 * @property int $type_id
 * 
 * @property \App\Models\Type $type
 * @property \Illuminate\Database\Eloquent\Collection $profiles
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $casts = [
		'access' => 'bool',
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
		'type_id'
	];

	public function type()
	{
		return $this->belongsTo(\App\Models\Type::class);
	}

	public function profiles()
	{
		return $this->hasMany(\App\Models\Profile::class);
	}
}
