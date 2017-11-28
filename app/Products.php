<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $guarded=['id'];

	public function tags() {
		return $this->hasMany( 'App\Product_Tags','fk_product_id');
    }

	public function colors() {
		return $this->hasMany( 'App\Product_Color','fk_product_id');
	}

	public function sizes() {
		return $this->hasMany( 'App\Product_Size','fk_product_id');
	}

	public function photos() {
		return $this->hasMany( 'App\Product_Photos','fk_product_id');
	}

	public function rating() {
		return $this->hasMany( 'App\Product_Rating','fk_product_id');
	}
}
