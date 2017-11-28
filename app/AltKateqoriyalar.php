<?php

namespace App;

use function htmlspecialchars;
use Illuminate\Database\Eloquent\Model;

class AltKateqoriyalar extends Model
{
	protected $table='alt_kateqoriyalar';
	protected $guarded=['id'];

	public static function alt_kateqoriyalar_by_id($id) {
		return AltKateqoriyalar::select('id','ad','slug')->where('foreign_kateqoriya_id','=',$id)->get()->toArray();
	}

	public static function alt_kateqoriya_adi($id){
		return AltKateqoriyalar::select('ad')->where('id','=',$id)->get()->first()->toArray()['ad'];
	}
}
