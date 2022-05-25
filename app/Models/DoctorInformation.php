<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class DoctorInformation extends Model
{
	protected $connection = 'mysql';
	protected $table = 'doctor_information';

	protected $fillable = [
		'doctor_id',
		'locale',
		'description'
	];
}
