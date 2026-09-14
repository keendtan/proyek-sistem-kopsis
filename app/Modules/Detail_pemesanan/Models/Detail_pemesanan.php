<?php

namespace App\Modules\Detail_pemesanan\Models;

use App\Helpers\UsesUuid;
use App\Modules\Barang\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail_pemesanan extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'detail_pemesanan';
	protected $fillable   = ['*'];


	public function barang()
	{
		return $this->belongsTo(Barang::class, 'barang_id');
	}

}
