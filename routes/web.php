<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Modules\Menu\Models\Menu;
use App\Modules\Barang\Models\Barang;
use App\Modules\Kategori\Models\Kategori;
use App\Modules\Transaksi\Models\Transaksi;

Route::view('/', 'welcome')->name('frontend.index');

Route::get('/riwayat-pesanan', function () {
    $transaksi = Transaksi::where('users_id', Auth::id())
        ->latest()
        ->first();

    return view('UsersKita.riwayat', [
        'transaksi' => $transaksi,
    ]);
})->middleware(['web', 'auth'])->name('riwayat.pesanan');

// Public home page for UsersKita — pass menu data so view has `$menus`
Route::get('/home', function (Request $request) {
    $query = Barang::query();
    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where('nama', 'like', "%{$search}%");
    }

    // filter by kategori if provided
    $selectedKategori = $request->get('kategori');
    if (!empty($selectedKategori) && $selectedKategori !== 'all') {
        // allow passing either kategori id or kategori name (e.g. 'makanan')
        if (preg_match('/^[0-9a-fA-F\-]{36}$/', $selectedKategori)) {
            $query->where('kategori_id', $selectedKategori);
        } else {
            $kat = Kategori::where('nama_kategori', $selectedKategori)->first();
            if ($kat) {
                $query->where('kategori_id', $kat->id);
                $selectedKategori = $kat->id; // normalize for view
            } else {
                // try case-insensitive name match
                $kat = Kategori::whereRaw('LOWER(nama_kategori) = ?', [strtolower($selectedKategori)])->first();
                if ($kat) {
                    $query->where('kategori_id', $kat->id);
                    $selectedKategori = $kat->id;
                }
            }
        }
    }

    $menus = $query->get()->map(function($m){
        $imagePath = $m->gambar ? 'barang/'.basename($m->gambar) : null;
        $imageUrl = $imagePath && Storage::disk('public')->exists($imagePath)
            ? asset('storage/'.$imagePath)
            : asset('assets/images/samples/banana.jpg');

        return [
            'id' => $m->id,
            'name' => $m->nama,
            'price' => $m->harga,
            'stock' => $m->stok,
            'image' => $imageUrl,
            'kategori_id' => $m->kategori_id,
        ];
    })->all();

    $kategoris = Kategori::all()->map(function($k){
        return ['id' => $k->id, 'nama' => $k->nama_kategori];
    })->all();

    return view('UsersKita.home', ['menus' => $menus, 'kategoris' => $kategoris, 'selectedKategori' => $selectedKategori]);
})->middleware(\App\Http\Middleware\RedirectIfNotUserKita::class)->name('home');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/role/set/{id_role}', [DashboardController::class,'changeRole'])->name('dashboard.change.role');
    Route::get('/forcelogout', [DashboardController::class,'forceLogout'])->name('dashboard.force.logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
