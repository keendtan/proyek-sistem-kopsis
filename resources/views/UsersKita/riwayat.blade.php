<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Status Pesanan</title>

    <style>
        :root {
            --maroon: #8b1e28;
            --maroon-soft: #c1585f;
            --cream: #fbf0e9;
            --brown: #3e2723;
            --idle: #7e97a2;
            --gray-bg: #e4e4e4;
            --green-bg: #dff3e6;
            --green-text: #1f7a3e;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: var(--cream);
            font-family: "Segoe UI", sans-serif;
        }

        .phone {
            width: 100%;
            max-width: none;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: var(--cream);
        }

        /* -------------------------
           HEADER
        ------------------------- */

        header {
            width: 100%;
            min-height: 64px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 22px max(20px, calc((100% - 960px) / 2));
            color: #fff;
            background: var(--maroon);
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
        }

        header a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            color: inherit;
            font-size: 22px;
            line-height: 1;
            text-decoration: none;
            flex-shrink: 0;
        }

        header h1 {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
        }

        /* -------------------------
           STEPPER
        ------------------------- */

        .stepper {
            width: 100%;
            max-width: 640px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin: 0 auto;
            padding: 44px 26px 24px;
        }

        .step {
            display: flex;
            width: 64px;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .icon {
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            border: 1.5px solid #262626;
            border-radius: 50%;
            color: #1c1c1c;
            background: #fff;
            transition:
                transform .3s ease,
                background .3s ease,
                border-color .3s ease,
                color .3s ease,
                box-shadow .3s ease;
        }

        .icon svg {
            width: 20px;
            height: 20px;
            display: block;
        }

        /* Hanya status yang sedang aktif berwarna merah. */
        .step.active .icon {
            border-color: var(--maroon);
            color: #fff;
            background: var(--maroon);
            transform: scale(1.12);
            box-shadow: 0 0 0 6px rgba(139, 30, 40, .15);
        }

        .label {
            color: var(--idle);
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }

        .step.active .label {
            color: var(--maroon);
        }

        .line {
            flex: 1;
            max-width: 180px;
            min-width: 40px;
            height: 3px;
            margin-top: 20px;
            background: var(--idle);
            transition: background .3s ease;
        }

        .line.active {
            background: var(--maroon);
        }

        /* -------------------------
           CARD PESANAN
        ------------------------- */

        .card-wrap {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 8px 20px 30px;
        }

        .order-card {
            width: 100%;
            min-height: 180px;
            padding: 18px 28px 22px;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 6px 18px #0000000f;
            transition: background .3s ease;
        }

        .order-card + .order-card {
            margin-top: 18px;
        }

        .order-card.gray {
            background: var(--gray-bg);
        }

        .order-card.green {
            background: var(--green-bg);
        }

        .order-card h2 {
            margin: 0 0 4px;
            color: var(--maroon);
            font-size: 18px;
            font-weight: 700;
            transition: color .3s ease;
        }

        .order-card.gray h2 {
            color: #4a4a4a;
        }

        .order-card.green h2 {
            color: var(--green-text);
        }

        .sub {
            margin-bottom: 16px;
            color: var(--maroon-soft);
            font-size: 12px;
            transition: color .3s ease;
        }

        .order-card.gray .sub {
            color: #8c8c8c;
        }

        .order-card.green .sub {
            color: #5cab7f;
        }

        /* -------------------------
           ITEM
        ------------------------- */

        .item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #333;
            font-size: 14px;
            font-weight: 600;
            gap: 20px;
        }

        .order-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .order-status {
            color: var(--maroon);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .order-items {
            margin: 12px 0 8px;
        }

        .product-row {
            display: grid;
            grid-template-columns: 54px minmax(0, 1fr) auto;
            align-items: center;
            gap: 12px;
            padding: 6px 0;
        }

        .product-row.hidden-item {
            display: none;
        }

        .product-image {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            object-fit: cover;
            background: #eee;
        }

        .product-name {
            color: var(--maroon);
            font-size: 14px;
            font-weight: 700;
            line-height: 1.25;
        }

        .product-quantity {
            display: block;
            margin-top: 2px;
            color: var(--maroon);
            font-size: 13px;
            font-weight: 700;
        }

        .product-price {
            color: var(--maroon);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .toggle-items {
            padding: 0;
            border: 0;
            color: var(--maroon-soft);
            background: transparent;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .toggle-items .arrow {
            display: inline-block;
            margin-left: 3px;
            transition: transform .2s ease;
        }

        .toggle-items[aria-expanded="true"] .arrow {
            transform: rotate(180deg);
        }

        hr {
            margin: 14px 0;
            border: none;
            border-top: 1px solid rgba(0, 0, 0, .08);
        }

        /* -------------------------
           BOTTOM CARD
        ------------------------- */

        .bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
            gap: 20px;
        }

        .subtotal-label {
            color: var(--maroon-soft);
            font-size: 12px;
            transition: color .3s ease;
        }

        .order-card.gray .subtotal-label {
            color: #8c8c8c;
        }

        .order-card.green .subtotal-label {
            color: #5cab7f;
        }

        .subtotal-value {
            color: var(--maroon);
            font-size: 15px;
            font-weight: 700;
            transition: color .3s ease;
        }

        .order-card.gray .subtotal-value {
            color: #3a3a3a;
        }

        .order-card.green .subtotal-value {
            color: var(--green-text);
        }

        /* -------------------------
           BUTTON
        ------------------------- */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border: 0;
            border-radius: 20px;
            color: #fff;
            background: var(--brown);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
            transition:
                opacity .2s ease,
                transform .2s ease;
        }

        .btn:hover {
            opacity: .9;
            transform: translateY(-1px);
        }

        /* -------------------------
           EMPTY
        ------------------------- */

        .empty {
            color: #777;
            font-size: 14px;
            text-align: center;
        }

          .order-summary {
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                gap: 20px;
          }

          /* -------------------------
              TABLET
          ------------------------- */

        @media (max-width: 700px) {
            header {
                padding: 20px;
            }

            .card-wrap {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        /* -------------------------
           MOBILE
        ------------------------- */

        @media (max-width: 500px) {
            header {
                min-height: 60px;
                padding: 18px 16px;
                border-bottom-left-radius: 14px;
                border-bottom-right-radius: 14px;
            }

            header h1 {
                font-size: 17px;
            }

            header a {
                font-size: 21px;
            }

            .card-wrap {
                padding: 8px 12px 28px;
            }

            .order-card {
                min-height: 170px;
                padding: 22px 18px;
                border-radius: 16px;
            }

            .order-card h2 {
                font-size: 16px;
                word-break: break-word;
            }

            .order-heading {
                gap: 8px;
            }

            .product-row {
                grid-template-columns: 54px minmax(0, 1fr) auto;
                gap: 10px;
            }

            .btn {
                padding: 9px 14px;
                font-size: 12px;
            }
        }

        /* -------------------------
           SMALL PHONE
        ------------------------- */

        @media (max-width: 380px) {
            .order-card {
                padding: 20px 15px;
            }

            .order-summary {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="phone">

        <header>
            <a href="{{ route('home') }}" aria-label="Kembali">&#8592;</a>
            <h1>Riwayat Pesanan</h1>
        </header>

        <div class="card-wrap">

            @forelse($transaksi as $order)
            <div class="order-card" id="order-card-{{ $order->id }}">

                    <div class="order-heading">
                        <div>
                            <h2>Pesanan No.{{ $order->kode_transaksi }}</h2>
                            <div class="sub">
                                Cravecourt, {{ \Carbon\Carbon::parse($order->tanggal)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                        <span class="order-status" data-order-status="{{ $order->id }}">
                            {{ $order->status === 'selesai' ? 'Pesanan Selesai' : 'Pesanan Diproses' }}
                        </span>
                    </div>

                    @php
                        $details = $order->details;
                        $visibleDetail = $details->first();
                    @endphp

                    @if($visibleDetail)
                        <div class="order-items" id="order-items-{{ $order->id }}">
                            @foreach($details as $index => $detail)
                                @php
                                    $imagePath = $detail->barang?->gambar ? 'barang/'.basename($detail->barang->gambar) : null;
                                    $imageUrl = $imagePath && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)
                                        ? asset('storage/'.$imagePath)
                                        : asset('assets/images/samples/banana.jpg');
                                @endphp
                                <div class="product-row {{ $index > 0 ? 'hidden-item' : '' }}" data-product-row>
                                    <img class="product-image" src="{{ $imageUrl }}" alt="{{ $detail->barang?->nama ?? 'Produk' }}">
                                    <div>
                                        <div class="product-name">{{ $detail->barang?->nama ?? 'Produk' }}</div>
                                        <span class="product-quantity">{{ $detail->jumlah }}x</span>
                                    </div>
                                    <span class="product-price">Rp. {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        @if($details->count() > 1)
                            <button type="button" class="toggle-items" aria-expanded="false" aria-controls="order-items-{{ $order->id }}">
                                <span class="toggle-label">Tampilkan lainnya</span><span class="arrow">⌄</span>
                            </button>
                        @endif
                    @endif

                    <hr>

                    <div class="order-summary">
                        <div>
                            <div class="subtotal-label">Total:</div>
                            <div class="subtotal-value">Rp. {{ number_format($order->total, 0, ',', '.') }}</div>
                        </div>
                        <a class="btn" href="{{ route('riwayat.pesanan.detail', $order) }}">Lihat Detail</a>
                    </div>

            </div>
            @empty
                <div class="order-card"><div class="empty">Belum ada pesanan.</div></div>
            @endforelse

        </div>

    </div>

    <script>
        document.querySelectorAll('.toggle-items').forEach((button) => {
            button.addEventListener('click', () => {
                const expanded = button.getAttribute('aria-expanded') === 'true';
                const container = document.getElementById(button.getAttribute('aria-controls'));

                container.querySelectorAll('[data-product-row]').forEach((row, index) => {
                    if (index > 0) {
                        row.classList.toggle('hidden-item', expanded);
                    }
                });

                button.setAttribute('aria-expanded', String(!expanded));
                button.querySelector('.toggle-label').textContent = expanded ? 'Tampilkan lainnya' : 'Sembunyikan lainnya';
            });
        });

        function loadOrderStatus(orderId) {
            return fetch(`/transaksi/${orderId}/status`, {
                headers: {
                    Accept: 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Status pesanan tidak dapat diambil.');
                }

                return response.json();
            })
            .then(data => {
                const status = data.status === 'selesai' ? 'Pesanan Selesai' : 'Pesanan Diproses';
                const statusElement = document.querySelector(`[data-order-status="${orderId}"]`);
                if (statusElement) statusElement.textContent = status;
            });
        }

        const orderIds = @json($transaksi->pluck('id')->values());
        orderIds.forEach((orderId) => loadOrderStatus(orderId).catch(() => {}));

        setInterval(() => {
            orderIds.forEach((orderId) => loadOrderStatus(orderId).catch(() => {}));
        }, 5000);
    </script>

</body>
</html>
