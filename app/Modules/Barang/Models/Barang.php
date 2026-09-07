<?php

namespace App\Modules\Barang\Models;

use App\Helpers\UsesUuid;
use App\Modules\Kategori\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Barang extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'barang';
	protected $fillable   = ['*'];

	public function kategori()
	{
		return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
	}
}
