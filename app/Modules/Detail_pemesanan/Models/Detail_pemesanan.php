<?php

namespace App\Modules\Detail_pemesanan\Models;

use App\Helpers\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail_pemesanan extends Model
{
	use SoftDeletes;
	use UsesUuid;

	public $incrementing = false;
	protected $keyType = 'string';

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'detail_pemesanan';
	protected $fillable   = ['*'];
}
