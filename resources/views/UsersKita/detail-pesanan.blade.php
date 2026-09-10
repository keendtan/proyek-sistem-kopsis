<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Pemesanan - CraveCourt</title>

<style>
  :root {
    --maroon: #7a1f2b;
    --maroon-dark: #5e161f;
    --cream: #fdf6f2;
    --ink: #2b1416;
    --muted: #6b5658;
    --line: #d8c9c3;
  }

  * {
    box-sizing: border-box;
  }

  html,
  body {
    margin: 0;
    padding: 0;
    min-height: 100%;
  }

  body {
    background: var(--cream);
    color: var(--ink);
    font-family: "Segoe UI", Tahoma, sans-serif;
  }

  /* =========================
     MAIN CONTAINER
  ========================= */

  .macbook {
    width: 100%;
    min-height: 100vh;
  }

  .screen {
    width: 100%;
    min-height: 100vh;
    background: var(--cream);
  }

  .screen-body {
    width: 100%;
    min-height: 100vh;
    padding: 0;
    background: var(--cream);
  }

  /*
    FULL WIDTH
    Tidak lagi dibatasi max-width 1180px
  */
  .phone {
    width: 100%;
    max-width: none;
    min-height: 100vh;
    margin: 0;
    overflow: hidden;
    background: var(--cream);
    border-radius: 0;
    box-shadow: none;
  }

  /* =========================
     TOPBAR MERAH FULL WIDTH
  ========================= */

  .topbar {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 14px;

    /*
      Isi tombol dan tulisan tetap sejajar
      dengan area receipt
    */
    padding: 18px max(20px, calc((100% - 1140px) / 2));

    color: #fbe9d6;
    background: var(--maroon);

    border-bottom-left-radius: 18px;
    border-bottom-right-radius: 18px;
  }

  .topbar a {
    display: flex;
    align-items: center;
    justify-content: center;

    color: inherit;
    font-size: 25px;
    line-height: 1;
    text-decoration: none;

    width: 28px;
    height: 28px;
  }

  .topbar h1 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
  }

  /* =========================
     RECEIPT / CARD
  ========================= */

  .receipt {
    width: 100%;
    max-width: 820px;

    margin: 34px auto 48px;
    padding: 34px 38px 42px;

    border: 1px solid rgba(140, 43, 43, 0.08);
    border-radius: 18px;

    background: #fff;

    box-shadow:
      0 10px 28px rgba(140, 43, 43, 0.14),
      0 2px 6px rgba(43, 26, 26, 0.05);
  }

  /* =========================
     BRAND
  ========================= */

  .brand {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
  }

  .brand-icon {
    width: 46px;
    height: 46px;
    flex-shrink: 0;
  }

  .brand-icon img {
    display: block;
    width: 45px;
    height: 45px;
    object-fit: contain;
  }

  .brand-name {
    margin: 0 0 4px;

    color: var(--maroon);

    font-family: "Arial Black", Arial, sans-serif;
    font-size: 26px;
    font-style: normal;
    font-weight: 800;

    letter-spacing: 0.5px;
  }

  .brand-address {
    margin: 0;
    color: var(--ink);
    font-size: 11.5px;
  }

  /* =========================
     DIVIDER
  ========================= */

  .divider-dash {
    margin: 18px 0;

    border: 0;
    border-top: 2px dashed var(--line);
  }

  /* =========================
     TRANSACTION INFO
  ========================= */

  .meta {
    color: var(--ink);
    font-size: 13px;
    line-height: 1.9;
  }

  .meta-row {
    display: flex;
    align-items: flex-start;
  }

  .meta-label {
    width: 92px;
    flex-shrink: 0;

    color: var(--maroon-dark);
    font-weight: 600;
  }

  .meta-colon {
    width: 14px;
    flex-shrink: 0;
  }

  /* =========================
     ITEMS TABLE
  ========================= */

  .items-table {
    width: 100%;
    margin-top: 4px;

    border-collapse: collapse;

    color: var(--ink);
    font-size: 13px;
  }

  .items-table th {
    padding-bottom: 8px;

    border-bottom: 2px dashed var(--line);

    color: var(--maroon);
    font-size: 12px;
    font-weight: 700;

    text-align: left;
  }

  .items-table th:not(:first-child),
  .items-table td:not(:first-child) {
    text-align: right;
  }

  .items-table td {
    padding: 12px 0 4px;
    vertical-align: top;
  }

  .item-name {
    padding-right: 8px !important;
  }

  /* =========================
     TOTALS
  ========================= */

  .totals td {
    padding-top: 10px;
    border-top: 2px dashed var(--line);
  }

  .totals tr:first-child td {
    padding-top: 14px;
    border-top: 0;
  }

  .totals .label {
    color: var(--muted);
  }

  .grand-total td {
    padding-top: 14px;

    border-top: 2px dashed var(--line);

    color: var(--maroon);

    font-size: 15px;
    font-weight: 700;
  }

  /* =========================
     FOOTER
  ========================= */

  .footer-note {
    margin-top: 26px;

    color: var(--muted);
    font-size: 12px;
    text-align: center;
  }

  /* =========================
     HIDE LAPTOP/BROWSER
  ========================= */

  .browser-chrome,
  .laptop-base {
    display: none;
  }

  /* =========================
     MOBILE
  ========================= */

  @media (max-width: 600px) {

    .topbar {
      padding: 16px 18px;
      border-bottom-left-radius: 14px;
      border-bottom-right-radius: 14px;
    }

    .topbar h1 {
      font-size: 17px;
    }

    .topbar a {
      font-size: 23px;
    }

    .receipt {
      width: calc(100% - 24px);
      margin: 22px 12px 32px;
      padding: 28px 16px 36px;
      border-radius: 16px;
    }

    .brand-name {
      font-size: 22px;
    }

    .brand-address {
      font-size: 10.5px;
      line-height: 1.4;
    }

    .meta {
      font-size: 12px;
    }

    .meta-label {
      width: 88px;
    }

    .items-table {
      font-size: 12px;
    }

    .items-table th {
      font-size: 11px;
    }
  }

  /* =========================
     SMALL PHONE
  ========================= */

  @media (max-width: 400px) {

    .receipt {
      padding: 24px 12px 30px;
    }

    .brand {
      gap: 9px;
    }

    .brand-icon {
      width: 40px;
      height: 40px;
    }

    .brand-icon img {
      width: 40px;
      height: 40px;
    }

    .brand-name {
      font-size: 19px;
    }

    .brand-address {
      font-size: 9.5px;
    }

    .meta {
      font-size: 11px;
    }

    .meta-label {
      width: 82px;
    }

    .items-table {
      font-size: 11px;
    }
  }
</style>
</head>

<body>

<div class="macbook">

  <div class="screen">

    <div class="screen-body">

      <div class="phone">

        <!-- =========================
             TOP BAR
        ========================== -->

        <div class="topbar">

          <a
            href="{{ route('riwayat.pesanan') }}"
            aria-label="Kembali"
          >
            &#8592;
          </a>

          <h1>Detail Pemesanan</h1>

        </div>


        <!-- =========================
             RECEIPT
        ========================== -->

        <div class="receipt">

          <!-- BRAND -->

          <div class="brand">

            <div class="brand-icon">

              <img
                src="{{ asset('assets/images/LOGO CRAVECOURT.png') }}"
                alt="Logo CraveCourt"
              >

            </div>

            <div>

              <p class="brand-name">
                CRAVECOURT
              </p>

              <p class="brand-address">
                Jl. Dr. Cipto No. 121 A, Kec. Semarang Timur, Kota Semarang
              </p>

            </div>

          </div>


          <hr class="divider-dash">


          <!-- =========================
               TRANSACTION INFO
          ========================== -->

          <div class="meta">

            <div class="meta-row">
              <span class="meta-label">
                No. Transaksi
              </span>

              <span class="meta-colon">
                :
              </span>

              <span>
                {{ $transaksi->kode_transaksi }}
              </span>
            </div>


            <div class="meta-row">

              <span class="meta-label">
                Tanggal
              </span>

              <span class="meta-colon">
                :
              </span>

              <span>
                {{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}
              </span>

            </div>


            <div class="meta-row">

              <span class="meta-label">
                Waktu
              </span>

              <span class="meta-colon">
                :
              </span>

              <span>
                {{ optional($transaksi->created_at)->format('H.i') ?? '-' }}
              </span>

            </div>


            <div class="meta-row">

              <span class="meta-label">
                Status
              </span>

              <span class="meta-colon">
                :
              </span>

              <span>
                {{ ucfirst($transaksi->status) }}
              </span>

            </div>

          </div>


          <hr class="divider-dash">


          <!-- =========================
               ITEMS
          ========================== -->

          <table class="items-table">

            <thead>

              <tr>

                <th>
                  ITEM
                </th>

                <th>
                  QTY
                </th>

                <th>
                  HARGA
                </th>

                <th>
                  TOTAL
                </th>

              </tr>

            </thead>


            <tbody>

              @forelse($items as $item)

              <tr>

                <td class="item-name">
                  {{ $item->barang->nama ?? 'Barang' }}
                </td>

                <td>
                  {{ $item->jumlah }}
                </td>

                <td>
                  {{ number_format($item->harga_satuan, 0, ',', '.') }}
                </td>

                <td>
                  {{ number_format($item->subtotal, 0, ',', '.') }}
                </td>

              </tr>

              @empty

              <tr>

                <td
                  colspan="4"
                  style="text-align:center;"
                >
                  Tidak ada item.
                </td>

              </tr>

              @endforelse

            </tbody>


            <!-- =========================
                 TOTAL
            ========================== -->

            <tbody class="totals">

              <tr>

                <td class="label">
                  Subtotal
                </td>

                <td></td>
                <td></td>

                <td>
                  {{ number_format($transaksi->total, 0, ',', '.') }}
                </td>

              </tr>


              <tr>

                <td class="label">
                  Diskon
                </td>

                <td></td>
                <td></td>

                <td>
                  0
                </td>

              </tr>


              <tr class="grand-total">

                <td>
                  TOTAL
                </td>

                <td></td>
                <td></td>

                <td>
                  Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                </td>

              </tr>

            </tbody>

          </table>


          <!-- FOOTER -->

          <p class="footer-note">
            Terima kasih telah memesan di CraveCourt!
          </p>

        </div>

      </div>

    </div>

  </div>
</div>
</body>
</html>