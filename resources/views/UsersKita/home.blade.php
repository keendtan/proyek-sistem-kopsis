
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Makanan</title>
    <style>
        :root {
            --maroon: #8c2b2b;
            --maroon-dark: #6e1f1f;
            --cream: #fdf6f1;
            --card-bg: #ffffff;
            --text-dark: #2b1a1a;
            --text-muted: #9a8b8b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
        }

        .app {
            max-width: 1200px;
            margin: 0 auto;
            min-height: 100vh;
            background: var(--cream);
            position: relative;
            padding-bottom: 80px;
            padding-left: 16px;
            padding-right: 16px;
        }

        /* ---------- Header ---------- */
        .header {
            background: var(--maroon);
            padding: 16px 16px 22px;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
        }

        .header-top {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-badge {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .search-bar {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border-radius: 999px;
            padding: 10px 14px;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 13px;
            color: var(--text-dark);
            background: transparent;
        }

        .search-bar input::placeholder {
            color: var(--text-muted);
        }

        .profile-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            flex-shrink: 0;
        }

        /* ---------- Grid ---------- */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 18px;
            padding: 18px 14px 10px;
        }

        .food-card {
            background: var(--card-bg);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(140, 43, 43, 0.08);
            display: flex;
            flex-direction: column;
        }

        .food-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            display: block;
        }

        .food-info {
            padding: 8px 10px 10px;
            position: relative;
        }

        .food-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--maroon);
            line-height: 1.3;
            margin-bottom: 2px;
            min-height: 30px;
        }

        .stock-badge {
            position: absolute;
            top: 8px;
            right: 10px;
            font-size: 9px;
            color: var(--text-muted);
        }

        .price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
        }

        .price {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .btn-add {
            background: var(--maroon);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-size: 10px;
            padding: 5px 12px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: var(--maroon-dark);
        }

        /* ---------- Bottom Nav ---------- */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            background: var(--maroon);
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 12px 20px;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }

        /* ---------- Top Nav ---------- */
        .top-nav {
            display:flex;
            gap:12px;
            background:#fff;
            padding:10px 14px;
            margin-top:10px;
            border-radius:12px;
            align-items:center;
            justify-content:space-between;
        }

        .top-nav .nav-item { color:var(--text-dark); text-decoration:none; padding:8px 12px; border-radius:8px; display:flex; gap:8px; align-items:center; }
        .top-nav .nav-item.active { background:var(--maroon); color:#fff; }

        /* Desktop adjustments */
        @media (min-width: 768px) {
            .app { padding-bottom: 24px; }
            .header { padding: 22px 24px; }
            .menu-grid { gap: 20px; }
            .food-card img { height: 160px; }
            /* Hide mobile bottom nav on larger screens */
            .bottom-nav { display: none; }
        }

        .bottom-nav .nav-item {
            color: #fff;
            opacity: 0.85;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        .bottom-nav .nav-item.active {
            background: #2b1a1a;
            border-radius: 50%;
            opacity: 1;
        }

        .bottom-nav svg { width: 18px; height: 18px; }

        .empty-state {
            text-align: center;
            padding: 40px 16px;
            color: var(--text-muted);
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>
    <div class="app">

        {{-- ================= HEADER ================= --}}
        <div class="header">
            <div class="header-top">
                <div class="logo-badge">🍜</div>

                <form action="{{ route('menu.index') ?? '#' }}" method="GET" class="search-bar">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9a8b8b" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nasi goreng spesial ga pedes karet 1...."
                    >
                </form>

                <a href="{{ route('profile.edit') ?? '#' }}" class="profile-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="8" r="4"></circle>
                        <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                    </svg>
                </a>
            </div>

            {{-- top nav moved inside header so it's visible on desktop --}}
            @php
                $rawKat = request('kategori') ?? 'all';
                // helper to get id for named kategori
                $getKatId = function($name) use ($kategoris) {
                    foreach($kategoris ?? [] as $k) {
                        if(strtolower($k['nama']) == strtolower($name)) return $k['id'];
                    }
                    return null;
                };
                $makananId = $getKatId('makanan');
                $minumanId = $getKatId('minuman');
                $snackId = $getKatId('snack');
            @endphp

            <div class="top-nav">
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('home', array_merge(request()->except('page'), ['kategori' => 'makanan'])) }}" class="nav-item {{ ($rawKat == 'makanan' || $rawKat == $makananId) ? 'active' : '' }}">Makanan</a>
                    <a href="{{ route('home', array_merge(request()->except('page'), ['kategori' => 'snack'])) }}" class="nav-item {{ ($rawKat == 'snack' || $rawKat == $snackId) ? 'active' : '' }}">Snack</a>
                    <a href="{{ route('home', array_merge(request()->except('page'), ['kategori' => 'minuman'])) }}" class="nav-item {{ ($rawKat == 'minuman' || $rawKat == $minumanId) ? 'active' : '' }}">Minuman</a>
                </div>
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('keranjang.index') ?? '#' }}" class="nav-item">Keranjang</a>
                    <a href="{{ route('transaksi.index') ?? '#' }}" class="nav-item">Riwayat</a>
                </div>
            </div>

        </div>
            <div style="padding:12px 14px 0; display:flex; gap:8px; align-items:center; overflow:auto;">
                @php $sel = $selectedKategori ?? 'all'; @endphp
                <a href="{{ route('home', array_merge(request()->except('page'), ['kategori' => 'all'])) }}" style="padding:8px 12px; border-radius:999px; text-decoration:none; font-weight:600; color:{{ $sel === 'all' ? '#fff' : 'var(--text-dark)' }}; background: {{ $sel === 'all' ? 'var(--maroon)' : '#fff' }};">
                    Semua
                </a>
                @if(!empty($kategoris))
                    @foreach($kategoris as $kat)
                        @php $active = $sel == $kat['id']; @endphp
                        <a href="{{ route('home', array_merge(request()->except('page'), ['kategori' => $kat['id']])) }}" style="padding:8px 12px; border-radius:999px; text-decoration:none; color:{{ $active ? '#fff' : 'var(--text-dark)' }}; background: {{ $active ? 'var(--maroon)' : 'rgba(255,255,255,0.9)' }};">
                            {{ $kat['nama'] }}
                        </a>
                    @endforeach
                @endif
            </div>

        {{-- ================= GRID MENU ================= --}}
        <div class="menu-grid">
            @forelse ($menus as $menu)
                <div class="food-card">
                    <img
                        src="{{ isset($menu['image']) ? asset('storage/barang/'.$menu['image']) : asset('images/placeholder-food.jpg') }}"
                        alt="{{ $menu['name'] }}"
                        loading="lazy"
                    >
                    <div class="food-info">
                        @if(!empty($menu['stock']))
                            <span class="stock-badge">Stok {{ $menu['stock'] }}</span>
                        @endif

                        <div class="food-name">{{ $menu['name'] }}</div>

                        <div class="price-row">
                            <span class="price">Rp.{{ number_format($menu['price'], 0, ',', '.') }}</span>

                            <form action="{{ route('keranjang.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="barang_id" value="{{ $menu['id'] ?? 0 }}">
                                <input type="hidden" name="barang_nama" value="{{ $menu['name'] ?? '' }}">
                                <input type="hidden" name="catatan_item" value="">
                                <input type="hidden" name="jumlah_barang" value="1">
                                <input type="hidden" name="total" value="{{ $menu['price'] ?? 0 }}">
                                <button type="submit" class="btn-add">+ Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    Menu tidak ditemukan.
                </div>
            @endforelse
        </div>

        {{-- ================= BOTTOM NAV ================= --}}
        <div class="bottom-nav">
            <a href="{{ route('menu.index') ?? '#' }}" class="nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="9"></circle>
                </svg>
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21s-6.7-4.35-9.3-8.1C.9 10.1 1.7 6.6 4.7 5.3c2-.9 4.2-.3 5.6 1.4l1.7 2 1.7-2c1.4-1.7 3.6-2.3 5.6-1.4 3 1.3 3.8 4.8 2 7.6C18.7 16.65 12 21 12 21z"/>
                </svg>
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M7 3h10l-1.5 14a2 2 0 0 1-2 1.8h-3a2 2 0 0 1-2-1.8L7 3z"/>
                    <line x1="7" y1="8" x2="17" y2="8"/>
                </svg>
            </a>
            <a href="{{ route('keranjang.index') ?? '#' }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/>
                </svg>
            </a>
            <a href="{{ route('transaksi.index') ?? '#' }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16v16H4z"/>
                    <path d="M8 10h8M8 14h5"/>
                </svg>
            </a>
        </div>

    </div>
</body>
</html>