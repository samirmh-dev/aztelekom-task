<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kateqoriyalar extends Model
{
    protected $table='kateqoriyalar';
    protected $guarded=['id'];

	public function alt_kateqoriyalar() {
		return $this->hasMany( 'App\AltKateqoriyalar','foreign_kateqoriya_id');
	}

	public static function kateqoriya_adi($id) {
		return Kateqoriyalar::select('ad')->where('id','=',$id)->get()->first()->toArray()['ad'];
	}

	public static function kateqoriyalar_hamisi() {
		return Kateqoriyalar::select('ad','id','alt_kateqoriya','slug')->get()->toArray();
	}
}
