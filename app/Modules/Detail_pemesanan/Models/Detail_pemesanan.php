<?php

namespace App\Modules\Detail_pemesanan\Models;

use App\Helpers\UsesUuid;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
>>>>>>> dc5c39354f5ca831fb09662cffeb39ed4672c634
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail_pemesanan extends Model
{
	use SoftDeletes;
	use UsesUuid;
<<<<<<< HEAD

	public $incrementing = false;
	protected $keyType = 'string';
=======
>>>>>>> dc5c39354f5ca831fb09662cffeb39ed4672c634

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'detail_pemesanan';
	protected $fillable   = ['*'];
}
