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
            --pill-inactive: #e9e2e2;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
        }

        .app {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            min-height: 100vh;
            background: var(--cream);
        }

        .header {
            background: var(--maroon);
            padding: 16px 16px 20px;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
        }

        .header-top {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
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
            min-width: 0;
            font-size: 13px;
            color: var(--text-dark);
            background: transparent;
        }

        .search-bar input::placeholder { color: var(--text-muted); }

        .icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            flex-shrink: 0;
            position: relative;
            text-decoration: none;
        }

        .icon-btn .badge {
            position: absolute;
            top: -3px;
            right: -3px;
            background: #fff;
            color: var(--maroon);
            font-size: 9px;
            font-weight: 700;
            min-width: 15px;
            height: 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
        }

        .category-scroll {
            display: flex;
            gap: 10px;
            padding: 18px 14px 6px;
            overflow-x: auto;
            scrollbar-width: none;
            max-width: 1180px;
            margin: 0 auto;
        }

        .category-scroll::-webkit-scrollbar { display: none; }

        .category-pill {
            flex-shrink: 0;
            padding: 9px 20px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 600;
            background: var(--pill-inactive);
            color: var(--text-dark);
            text-decoration: none;
            white-space: nowrap;
            transition: background .15s, color .15s;
        }

        .category-pill.active {
            background: var(--maroon);
            color: #fff;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 14px 14px 24px;
            max-width: 1180px;
            margin: 0 auto;
        }

        .food-card {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(140, 43, 43, 0.08);
            display: flex;
            flex-direction: column;
        }

        .food-card img {
            width: 100%;
            height: 68px;
            object-fit: cover;
            display: block;
        }

        .food-info { padding: 6px 7px 8px; position: relative; }

        .food-name {
            font-size: 9.5px;
            font-weight: 600;
            color: var(--maroon);
            line-height: 1.25;
            margin-bottom: 2px;
            min-height: 24px;
        }

        .stock-badge {
            position: absolute;
            top: 6px;
            right: 7px;
            font-size: 7px;
            color: var(--text-muted);
        }

        .price {
            font-size: 9.5px;
            font-weight: 700;
            color: var(--text-dark);
            display: block;
            margin-bottom: 5px;
        }

        .btn-add {
            width: 100%;
            background: var(--maroon);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-size: 8.5px;
            padding: 4px 0;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-add:hover { background: var(--maroon-dark); }

        .empty-state {
            text-align: center;
            padding: 40px 16px;
            color: var(--text-muted);
            grid-column: 1 / -1;
        }

        @media (max-width: 380px) {
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (min-width: 768px) {
            body { background: #f3e9e2; }

            .header {
                padding: 22px 32px 26px;
                border-bottom-left-radius: 24px;
                border-bottom-right-radius: 24px;
            }

            .header-top { gap: 16px; }

            .logo-badge,
            .icon-btn {
                width: 42px;
                height: 42px;
            }

            .logo-badge { img-size: 20px; }
            .icon-btn svg { width: 20px; height: 20px; }

            .search-bar {
                max-width: 720px;
                padding: 13px 18px;
            }

            .search-bar input { font-size: 14px; }

            .category-scroll {
                gap: 12px;
                padding: 26px 32px 10px;
            }

            .category-pill {
                padding: 11px 24px;
                font-size: 14px;
            }

            .menu-grid {
                grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
                gap: 20px;
                padding: 20px 32px 40px;
            }

            .food-card { border-radius: 16px; }

            .food-card img { height: 150px; }

            .food-info { padding: 12px 14px 14px; }

            .food-name {
                font-size: 14px;
                min-height: 36px;
            }

            .stock-badge {
                top: 12px;
                right: 14px;
                font-size: 10px;
            }

            .price {
                font-size: 13px;
                margin-bottom: 10px;
            }

            .btn-add {
                font-size: 12px;
                padding: 8px 0;
            }
        }
    </style>
</head>
<body>
    @php
        $selected = $selectedKategori ?? 'all';
        $categoryUrl = function ($category) {
            return route('home', array_merge(request()->except('page'), ['kategori' => $category]));
        };
    @endphp

    <div class="app">
        <header class="header">
            <div class="header-top">
                <div class="logo-badge">
                    <img src="{{ asset('assets/images/LOGO CRAVECOURT.png') }}" alt="Logo" style="width: 24px; height: 24px;">
                </div>

                <form action="{{ route('home') }}" method="GET" class="search-bar">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9a8b8b" stroke-width="2" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu makanan..." aria-label="Cari menu">
                </form>

                <a href="{{ route('profile.edit') }}" class="icon-btn" aria-label="Profil">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <circle cx="12" cy="8" r="4"></circle>
                        <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                    </svg>
                </a>

                <a href="{{ route('keranjang.index') }}" class="icon-btn" aria-label="Keranjang">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/>
                    </svg>
                    @if(!empty($cartCount))
                        <span class="badge">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <nav class="category-scroll" aria-label="Kategori menu">
            <a href="{{ $categoryUrl('all') }}" class="category-pill {{ $selected === 'all' || empty($selected) ? 'active' : '' }}">Semua</a>
            @foreach ($kategoris ?? [] as $category)
                <a href="{{ $categoryUrl($category['id']) }}" class="category-pill {{ (string) $selected === (string) $category['id'] ? 'active' : '' }}">
                    {{ $category['nama'] }}
                </a>
            @endforeach
            <a href="{{ route('riwayat.pesanan') }}" class="category-pill {{ request()->routeIs('riwayat.pesanan') ? 'active' : '' }}">Riwayat</a>
        </nav>

        <main class="menu-grid">
            @forelse ($menus as $menu)
                <article class="food-card">
                    @php
                        $imageUrl = $menu['image'];
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $menu['name'] }}" loading="lazy">
                    <div class="food-info">
                        @if(!empty($menu['stock']))
                            <span class="stock-badge">Stok {{ $menu['stock'] }}</span>
                        @endif
                        <div class="food-name">{{ $menu['name'] }}</div>
                        <span class="price">Rp.{{ number_format($menu['price'], 0, ',', '.') }}</span>
                        <form class="add-to-cart-form" action="{{ route('keranjang.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $menu['id'] ?? 0 }}">
                            <input type="hidden" name="barang_nama" value="{{ $menu['name'] ?? '' }}">
                            <input type="hidden" name="catatan_item" value="">
                            <input type="hidden" name="jumlah_barang" value="1">
                            <input type="hidden" name="total" value="{{ $menu['price'] ?? 0 }}">
                            <input type="hidden" name="image" value="{{ $imageUrl }}">
                            <button type="submit" class="btn-add">+ Tambah</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty-state">Menu tidak ditemukan.</div>
            @endforelse
        </main>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const CART_KEY = 'cravecourt_cart';

        document.querySelectorAll('.add-to-cart-form').forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const id = form.querySelector('[name="barang_id"]').value;
                const name = form.querySelector('[name="barang_nama"]').value;
                const price = Number(form.querySelector('[name="total"]').value || 0);
                const image = form.querySelector('[name="image"]').value;

                const cart = JSON.parse(localStorage.getItem(CART_KEY) || '[]');
                const existing = cart.find((item) => String(item.id) === String(id));

                if (existing) {
                    existing.qty += 1;
                } else {
                    cart.push({
                        id,
                        name,
                        price,
                        image,
                        qty: 1,
                        note: ''
                    });
                }

                localStorage.setItem(CART_KEY, JSON.stringify(cart));
                window.location.href = "{{ route('keranjang.index') }}";
            });
        });
    });
</script>
</body>
</html>
