<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 07 Jun 2018 12:04:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Specialty
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $doctors
 *
 * @package App\Models
 */
class Specialty extends Eloquent
{
	protected $fillable = [
		'name'
	];

	public function doctors()
	{
		return $this->hasMany(\App\Models\Doctor::class);
	}
}
