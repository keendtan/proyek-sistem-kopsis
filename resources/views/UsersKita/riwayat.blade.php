<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Pesanan</title>

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
            padding: 28px;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 6px 18px #0000000f;
            transition: background .3s ease;
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
            margin-bottom: 14px;
            color: #333;
            font-size: 14px;
            font-weight: 600;
            gap: 20px;
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

        /* -------------------------
           TABLET
        ------------------------- */

        @media (max-width: 700px) {
            header {
                padding: 20px;
            }

            .stepper {
                padding-left: 16px;
                padding-right: 16px;
            }

            .line {
                min-width: 30px;
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

            .stepper {
                padding: 34px 10px 22px;
            }

            .step {
                width: 55px;
            }

            .icon {
                width: 38px;
                height: 38px;
            }

            .icon svg {
                width: 18px;
                height: 18px;
            }

            .label {
                font-size: 10px;
            }

            .line {
                min-width: 20px;
                height: 3px;
                margin-top: 18px;
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

            .item-row {
                font-size: 13px;
            }

            .bottom {
                align-items: flex-end;
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
            .stepper {
                padding-left: 5px;
                padding-right: 5px;
            }

            .step {
                width: 48px;
            }

            .icon {
                width: 35px;
                height: 35px;
            }

            .icon svg {
                width: 17px;
                height: 17px;
            }

            .label {
                font-size: 9px;
            }

            .line {
                min-width: 15px;
            }

            .order-card {
                padding: 20px 15px;
            }

            .bottom {
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

        <!-- STEPPER: DIPROSES → SELESAI -->
        <div class="stepper">

            <!-- Step 1: Diproses -->
            <div class="step" data-step="0">
                <div class="icon">
                    <!-- Panci -->
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">
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

            <!-- Step 2: Selesai -->
            <div class="step" data-step="1">
                <div class="icon">
                    <!-- Centang -->
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="3"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                </div>

                <div class="label">Selesai</div>
            </div>

        </div>

        <div class="card-wrap">

            <div class="order-card" id="orderCard">

                @if($transaksi)

                    <h2>
                        Pesanan No.{{ $transaksi->kode_transaksi }}
                    </h2>

                    <div class="sub">
                        {{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}
                    </div>

                    <div class="item-row">
                        <span>Total Pesanan</span>

                        <span>
                            Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                        </span>
                    </div>

                    <hr>

                    <div class="bottom">

                        <div>
                            <div class="subtotal-label">
                                Subtotal:
                            </div>

                            <div class="subtotal-value">
                                Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                            </div>
                        </div>

                        <a
                            class="btn"
                            href="{{ route('riwayat.pesanan.detail', $transaksi) }}"
                        >
                            Lihat Detail
                        </a>

                    </div>

                @else

                    <div class="empty">
                        Belum ada riwayat pesanan.
                    </div>

                @endif

            </div>

        </div>

    </div>

    @if($transaksi)

    <script>
        const orderId = @json($transaksi->id);

        // Hanya ada 2 status:
        // 0 = diproses
        // 1 = selesai
        const ORDER = ['diproses', 'selesai'];

        function setOrderStatus(status) {
            // Kalau status lama masih "diambil",
            // tampilkan sebagai diproses.
            if (status === 'diambil') {
                status = 'diproses';
            }

            const idx = ORDER.indexOf(status);

            if (idx < 0) {
                return;
            }

            // Hanya step yang sedang aktif yang berwarna merah.
            document.querySelectorAll('.step').forEach((step, i) => {
                step.classList.toggle('active', i === idx);
            });

            // Garis aktif setelah mencapai step berikutnya.
            document.querySelectorAll('.line').forEach((line, i) => {
                line.classList.toggle('active', i < idx);
            });

            const card = document.getElementById('orderCard');

            card.classList.remove('gray', 'green');

            if (status === 'selesai') {
                card.classList.add('green');
            }
        }

        function loadOrderStatus() {
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
                setOrderStatus(data.status);
            });
        }

        loadOrderStatus().catch(() => {});

        setInterval(() => {
            loadOrderStatus().catch(() => {});
        }, 5000);
    </script>

    @endif

</body>
</html>
