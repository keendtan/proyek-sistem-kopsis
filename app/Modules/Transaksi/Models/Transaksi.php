<?php

namespace App\Modules\Transaksi\Models;

use App\Helpers\UsesUuid;
use App\Modules\Detail_pemesanan\Models\Detail_pemesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'transaksi';
	protected $fillable   = ['*'];

	public function details()
	{
		return $this->hasMany(Detail_pemesanan::class, 'transaksi_id');
	}


}
