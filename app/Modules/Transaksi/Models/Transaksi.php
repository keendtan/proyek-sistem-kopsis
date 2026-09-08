<?php

namespace App\Modules\Transaksi\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaksi extends Model
{
	use SoftDeletes;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'transaksi';
	protected $fillable   = ['*'];

	
}
