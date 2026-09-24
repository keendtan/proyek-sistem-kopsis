<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Status Pesanan</title>
    <style>
        :root {
            --maroon: #a9272d;
            --cream: #fffaf7;
            --muted: #c98586;
            --brown: #49302f;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--cream);
            color: var(--maroon);
            font-family: "Segoe UI", sans-serif;
        }

        .page {
            min-height: 100vh;
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            background: var(--cream);
        }

        header {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 64px;
            padding: 18px max(24px, calc((100% - 960px) / 2));
            color: #fff;
            background: var(--maroon);
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
        }

        header a {
            color: inherit;
            font-size: 24px;
            line-height: 1;
            text-decoration: none;
        }

        h1 {
            margin: 0;
            font-size: 22px;
        }

        .status-card {
            width: min(920px, calc(100% - 48px));
            margin: 40px auto 24px;
            padding: 28px;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 6px 18px rgba(72, 35, 30, .12);
        }

        .status-card h2 {
            margin: 0 0 8px;
            font-size: 18px;
        }

        .order-code {
            margin: 0 0 16px;
            color: var(--muted);
            font-size: 13px;
        }

        .progress {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin: 20px auto 30px;
            max-width: 440px;
        }

        .step {
            display: flex;
            width: 92px;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .step-icon {
            display: grid;
            width: 48px;
            height: 48px;
            place-items: center;
            border: 2px solid #bbb;
            border-radius: 50%;
            color: #999;
            background: #fff;
        }

        .step-icon svg { width: 23px; height: 23px; }

        .step.active .step-icon {
            border-color: var(--maroon);
            color: #fff;
            background: var(--maroon);
            box-shadow: 0 0 0 6px rgba(169, 39, 45, .12);
        }

        .step-label {
            color: #999;
            font-size: 13px;
            font-weight: 700;
        }

        .step.active .step-label { color: var(--maroon); }

        .connector {
            width: 110px;
            height: 4px;
            margin-top: 22px;
            background: #bbb;
        }

        .connector.active { background: var(--maroon); }

        .info {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .total {
            margin: 12px 0 22px;
            color: var(--maroon);
            font-size: 18px;
            font-weight: 700;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .button {
            display: inline-flex;
            justify-content: center;
            padding: 11px 18px;
            border-radius: 999px;
            color: #fff;
            background: var(--brown);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .button.secondary {
            color: var(--maroon);
            background: #f4d8d5;
        }

        .order-total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 22px 0 14px;
            color: #333;
            font-size: 14px;
            font-weight: 600;
        }

        hr {
            margin: 0;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .summary {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-top: 14px;
        }

        .summary-label {
            color: var(--muted);
            font-size: 12px;
        }

        .summary-value {
            color: var(--maroon);
            font-size: 15px;
            font-weight: 700;
        }

        @media (max-width: 430px) {
            .status-card { margin: 28px 14px 20px; padding: 24px 14px; }
            h1 { font-size: 19px; }
            .connector { width: 70px; }
        }
    </style>
</head>
<body>
    <main class="page">
        <header>
            <a href="{{ route('home') }}" aria-label="Kembali">&#8592;</a>
            <h1>Status Pesanan</h1>
        </header>

        <div class="progress" aria-label="Progres pesanan">
                <div class="step active" data-step="diproses">
                    <div class="step-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 10h16M6 10v3a6 6 0 0 0 12 0v-3M8 6v4M12 5v5M16 6v4" />
                        </svg>
                    </div>
                    <span class="step-label">Diproses</span>
                </div>

                <div class="connector" data-connector></div>

                <div class="step" data-step="selesai">
                    <div class="step-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m5 12 4 4L19 6" />
                        </svg>
                    </div>
                    <span class="step-label">Selesai</span>
                </div>
        </div>

        <section class="status-card" id="statusCard">
            <h2>Pesanan No.{{ $transaksi->kode_transaksi }}</h2>
            <p class="order-code">{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}</p>

            <div class="order-total">
                <span>Total Pesanan</span>
                <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
            </div>

            <hr>

            <div class="summary">
                <div>
                    <div class="summary-label">Subtotal:</div>
                    <div class="summary-value">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</div>
                </div>
                <a class="button" href="{{ route('riwayat.pesanan.detail', $transaksi) }}">Lihat Detail</a>
            </div>

            <p class="info" id="statusMessage" hidden>Pesanan sedang diproses.</p>

        </section>
    </main>

    <script>
        const orderId = @json($transaksi->id);

        function updateStatus(status) {
            const isComplete = status === 'selesai';
            document.querySelector('[data-step="diproses"]').classList.toggle('active', !isComplete);
            document.querySelector('[data-step="selesai"]').classList.toggle('active', isComplete);
            document.querySelector('[data-connector]').classList.toggle('active', isComplete);
            document.getElementById('statusMessage').textContent = isComplete
                ? 'Pesanan sudah selesai.'
                : 'Pesanan sedang diproses.';
        }

        function loadStatus() {
            return fetch(`/transaksi/${orderId}/status`, { headers: { Accept: 'application/json' } })
                .then(response => response.ok ? response.json() : Promise.reject())
                .then(data => updateStatus(data.status));
        }

        loadStatus().catch(() => {});
        setInterval(() => loadStatus().catch(() => {}), 5000);
    </script>
</body>
</html>