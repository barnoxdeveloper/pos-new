<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
	protected $fillable =['product_id', 'name', 'price', 'descriptions', 'types', 'status'];

	//inisalisasi nama tabel
	protected $table = 'products';

	protected $hidden = [
		'',
	];
	//mengisi timestaps (created _at dan update_at) di data base
	public $timestamps = true;
    //inisialisasi primarykey pada tabel
	protected $primaryKey = 'id';
}
