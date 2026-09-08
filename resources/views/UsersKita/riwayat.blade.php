<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Pesanan</title>
    <style>
        :root { --maroon: #8b1e28; --maroon-soft: #c1585f; --cream: #fbf0e9; --brown: #3e2723; --idle: #7e97a2; --gray-bg: #e4e4e4; --green-bg: #dff3e6; --green-text: #1f7a3e; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--cream); font-family: "Segoe UI", sans-serif; }
        .phone { width: 100%; min-height: 100vh; overflow: hidden; background: var(--cream); }
        header { display: flex; align-items: center; gap: 14px; padding: 22px max(20px, calc((100% - 960px) / 2)); color: #fff; background: var(--maroon); }
        header a { color: inherit; font-size: 22px; text-decoration: none; }
        h1 { margin: 0; font-size: 19px; }
        .stepper { display: flex; align-items: flex-start; justify-content: center; max-width: 640px; margin: 0 auto; padding: 44px 26px 24px; }
        .step { display: flex; width: 64px; flex-direction: column; align-items: center; gap: 8px; }
        .icon { display: grid; width: 42px; height: 42px; place-items: center; border: 1.5px solid #262626; border-radius: 50%; color: #1c1c1c; background: #fff; transition: transform .3s ease, background .3s ease, border-color .3s ease, color .3s ease, box-shadow .3s ease; }
        .icon svg { width: 20px; height: 20px; display: block; }
        /* PENTING: hanya step yang SEDANG AKTIF yang berwarna merah.
           Step yang sudah lewat TIDAK ikut diwarnai lagi — jangan tambahkan
           class "done"/"completed" atau logic sejenis di sini maupun di JS. */
        .step.active .icon {
            border-color: var(--maroon); color: #fff; background: var(--maroon);
            transform: scale(1.12);
            box-shadow: 0 0 0 6px rgba(139,30,40,.15);
        }
        .label { color: var(--idle); font-size: 12px; font-weight: 600; }
        .step.active .label { color: var(--maroon); }
        .line { flex: 1; max-width: 180px; height: 3px; margin-top: 20px; background: var(--idle); transition: background .3s ease; }
        .line.active { background: var(--maroon); }
        .card-wrap { max-width: 960px; margin: 0 auto; padding: 8px 20px 30px; }
        .order-card { min-height: 180px; padding: 28px; border-radius: 18px; background: #fff; box-shadow: 0 6px 18px #0000000f; transition: background .3s ease; }
        .order-card.gray { background: var(--gray-bg); }
        .order-card.green { background: var(--green-bg); }
        .order-card h2 { margin: 0 0 4px; color: var(--maroon); font-size: 18px; transition: color .3s ease; }
        .order-card.gray h2 { color: #4a4a4a; }
        .order-card.green h2 { color: var(--green-text); }
        .sub { margin-bottom: 16px; color: var(--maroon-soft); font-size: 12px; transition: color .3s ease; }
        .order-card.gray .sub { color: #8c8c8c; }
        .order-card.green .sub { color: #5cab7f; }
        .empty { color: #777; font-size: 14px; text-align: center; }
        .item-row { display: flex; justify-content: space-between; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 14px; }
        hr { border: none; border-top: 1px solid rgba(0,0,0,.08); margin: 14px 0; }
        .bottom { display: flex; align-items: center; justify-content: space-between; margin-top: 4px; }
        .subtotal-label { font-size: 12px; color: var(--maroon-soft); transition: color .3s ease; }
        .order-card.gray .subtotal-label { color: #8c8c8c; }
        .order-card.green .subtotal-label { color: #5cab7f; }
        .subtotal-value { font-weight: 700; font-size: 15px; color: var(--maroon); transition: color .3s ease; }
        .order-card.gray .subtotal-value { color: #3a3a3a; }
        .order-card.green .subtotal-value { color: var(--green-text); }
        .btn { padding: 10px 18px; border: 0; border-radius: 20px; color: #fff; background: var(--brown); font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>
    <div class="phone">
        <header>
            <a href="{{ route('home') }}" aria-label="Kembali">&#8592;</a>
            <h1>Riwayat Pesanan</h1>
        </header>
        <div class="stepper">
            <div class="step" data-step="0">
                <div class="icon">
                    <!-- Panci -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="9" y1="4.5" x2="9" y2="7"/>
                        <line x1="12" y1="3.5" x2="12" y2="7"/>
                        <line x1="15" y1="4.5" x2="15" y2="7"/>
                        <path d="M4 10.5h16"/>
                        <path d="M3 9.5a1 1 0 0 1 1-1h1v2H4a1 1 0 0 1-1-1z"/>
                        <path d="M21 9.5a1 1 0 0 0-1-1h-1v2h1a1 1 0 0 0 1-1z"/>
                        <path d="M5.5 10.5v2a6.5 6.5 0 0 0 13 0v-2"/>
                    </svg>
                </div>
                <div class="label">Diproses</div>
            </div>
            <div class="line" data-line="0"></div>
            <div class="step" data-step="1">
                <div class="icon">
                    <!-- Kotak paket -->
                    <svg viewBox="0 0 24 24">
                        <polygon points="12,3 19,7 12,11 5,7" fill="currentColor" fill-opacity="1"/>
                        <polygon points="5,7 12,11 12,20 5,16" fill="currentColor" fill-opacity="0.55"/>
                        <polygon points="19,7 12,11 12,20 19,16" fill="currentColor" fill-opacity="0.8"/>
                    </svg>
                </div>
                <div class="label">Diambil</div>
            </div>
            <div class="line" data-line="1"></div>
            <div class="step" data-step="2">
                <div class="icon">
                    <!-- Centang -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                </div>
                <div class="label">Selesai</div>
            </div>
        </div>
        <div class="card-wrap">
            <div class="order-card" id="orderCard">
                @if($transaksi)
                    <h2>Pesanan No.{{ $transaksi->kode_transaksi }}</h2>
                    <div class="sub">{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}</div>
                    <div class="item-row">
                        <span>Total Pesanan</span>
                        <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="bottom">
                        <div>
                            <div class="subtotal-label">Subtotal:</div>
                            <div class="subtotal-value">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</div>
                        </div>
                        <button class="btn" type="button">Lihat Detail</button>
                    </div>
                @else
                    <div class="empty">Belum ada riwayat pesanan.</div>
                @endif
            </div>
        </div>
    </div>
    @if($transaksi)
    <script>
        const orderId = @json($transaksi->id);
        const ORDER = ['diproses', 'diambil', 'selesai'];
        const LABEL = { diproses: 'Sedang diproses', diambil: 'Sedang diambil', selesai: 'Pesanan selesai' };

        // PENTING: hanya step yang index-nya SAMA DENGAN status sekarang (i === idx)
        // yang diberi class "active". Jangan tambahkan logic classList untuk step
        // yang sudah terlewati (i < idx) — itu yang bikin tampilannya beda dari Figma.

        function setOrderStatus(status) {
            const idx = ORDER.indexOf(status);
            if (idx < 0) return;

            document.querySelectorAll('.step').forEach((step, i) => {
                step.classList.toggle('active', i === idx);
            });

            document.querySelectorAll('.line').forEach((line, i) => {
                line.classList.toggle('active', i <= idx);
            });

            const card = document.getElementById('orderCard');
            card.classList.remove('gray', 'green');
            if (status === 'diambil') card.classList.add('gray');
            if (status === 'selesai') card.classList.add('green');

        }

        function loadOrderStatus() {
            return fetch(`/transaksi/${orderId}/status`, { headers: { Accept: 'application/json' } })
                .then(response => {
                    if (!response.ok) throw new Error('Status pesanan tidak dapat diambil.');
                    return response.json();
                })
                .then(data => setOrderStatus(data.status));
        }

        loadOrderStatus().catch(error => document.getElementById('statusText').textContent = error.message);
        setInterval(() => loadOrderStatus().catch(() => {}), 5000);
    </script>
    @endif
</body>
</html>
