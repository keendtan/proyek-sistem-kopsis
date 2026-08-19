<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Modules\Menu\Models\Menu;
use App\Modules\Barang\Models\Barang;
use App\Modules\Kategori\Models\Kategori;

Route::view('/', 'welcome')->name('frontend.index');

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
            $kat = Kategori::where('nama', $selectedKategori)->orWhere('slug', $selectedKategori)->first();
            if ($kat) {
                $query->where('kategori_id', $kat->id);
                $selectedKategori = $kat->id; // normalize for view
            } else {
                // try case-insensitive name match
                $kat = Kategori::whereRaw('LOWER(nama) = ?', [strtolower($selectedKategori)])->first();
                if ($kat) {
                    $query->where('kategori_id', $kat->id);
                    $selectedKategori = $kat->id;
                }
            }
        }
    }

    $menus = $query->get()->map(function($m){
        return [
            'id' => $m->id,
            'name' => $m->nama,
            'price' => $m->harga,
            'stock' => $m->stok,
            'image' => $m->gambar,
            'kategori_id' => $m->kategori_id,
        ];
    })->all();

    $kategoris = Kategori::all()->map(function($k){
        return ['id' => $k->id, 'nama' => $k->nama ?? $k->name ?? ''];
    })->all();

    return view('UsersKita.home', ['menus' => $menus, 'kategoris' => $kategoris, 'selectedKategori' => $selectedKategori]);
})->name('home');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/role/set/{id_role}', [DashboardController::class,'changeRole'])->name('dashboard.change.role');
    Route::get('/forcelogout', [DashboardController::class,'forceLogout'])->name('dashboard.force.logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
