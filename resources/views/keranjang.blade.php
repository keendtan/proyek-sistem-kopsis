<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Cravecourt</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        .container {
            min-height: 100vh;
            background: white;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        .header {
            background: #ae282d;
            color: white;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .back {
            font-size: 24px;
            margin-right: 15px;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .back:hover {
            opacity: 0.8;
        }

        .header h2 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 13px;
            opacity: 0.9;
        }

        /* CONTENT WRAPPER */
        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 30px 20px;
            flex: 1;
        }

        /* CONTENT */
        .content {
            flex: 1;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #999;
            font-size: 16px;
        }

        /* CARD PRODUK */
        .cart-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
            display: grid;
            grid-template-columns: 100px 1fr 100px;
            gap: 20px;
            align-items: start;
            position: relative;
            transition: box-shadow 0.3s;
        }

        .cart-item:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .product-info h3 {
            color: #a51e27;
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .portion {
            color: #666;
            font-size: 13px;
        }

        .note {
            width: 100%;
            height: 36px;
            border: 1px dashed #ef8d8d;
            border-radius: 4px;
            padding: 8px 10px;
            font-size: 12px;
            color: #999;
        }

        .note::placeholder {
            color: #ccc;
        }

        .total-item {
            color: #a51e27;
            font-size: 14px;
            font-weight: 600;
        }

        /* PRODUCT ACTIONS */
        .product-actions {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: flex-end;
        }

        /* TOMBOL HAPUS */
        .delete {
            border: none;
            background: #ff6b6b;
            color: white;
            font-size: 20px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .delete:hover {
            background: #ff5252;
        }

        /* QUANTITY */
        .quantity {
            display: flex;
            gap: 8px;
            align-items: center;
            background: #f5f5f5;
            padding: 5px;
            border-radius: 4px;
        }

        .qty-btn {
            width: 28px;
            height: 28px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .qty-btn:hover {
            opacity: 0.8;
        }

        .minus {
            background: #999;
            color: white;
        }

        .plus {
            background: #a00028;
            color: white;
        }

        .qty-input {
            width: 40px;
            height: 28px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
        }

        /* ADD MORE */
        .add-more {
            color: #a00028;
            font-size: 13px;
            font-weight: 600;
            margin: 20px 0;
            cursor: pointer;
            display: inline-block;
            padding: 10px 15px;
            border: 2px solid #a00028;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .add-more:hover {
            background: #a00028;
            color: white;
        }

        /* SUMMARY SIDEBAR */
        .summary-sidebar {
            position: sticky;
            top: 100px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* SUMMARY */
        .summary {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
        }

        .summary-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        .summary-row span:last-child {
            font-weight: 600;
            color: #333;
        }

        .summary hr {
            border: none;
            border-top: 1px solid #f0f0f0;
            margin: 15px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            color: #a51e27;
            font-size: 16px;
            font-weight: 700;
        }

        /* CHECKOUT */
        .checkout {
            width: 100%;
            height: 48px;
            background: #980b2b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .checkout:hover {
            background: #7d0924;
        }

        .lock {
            font-size: 18px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .content-wrapper {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px 15px;
            }

            .header h2 {
                font-size: 20px;
            }

            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 15px;
                padding: 15px;
            }

            .product-image {
                width: 80px;
                height: 80px;
                grid-row: span 2;
            }

            .product-info h3 {
                font-size: 14px;
            }

            .note {
                height: 32px;
                font-size: 11px;
            }

            .product-actions {
                grid-column: 2;
                align-items: flex-start;
                flex-direction: row;
                justify-content: space-between;
                gap: 10px;
            }

            .delete {
                width: 28px;
                height: 28px;
                font-size: 16px;
            }

            .summary-sidebar {
                position: static;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }

            .header {
                padding: 15px;
            }

            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .back {
                margin-bottom: 10px;
                margin-right: 0;
            }

            .header h2 {
                font-size: 18px;
            }

            .header p {
                font-size: 11px;
            }

            .cart-item {
                grid-template-columns: 70px 1fr;
                gap: 10px;
                padding: 12px;
                margin-bottom: 10px;
            }

            .product-image {
                width: 70px;
                height: 70px;
            }

            .product-info h3 {
                font-size: 12px;
            }

            .portion {
                font-size: 11px;
            }

            .total-item {
                font-size: 12px;
            }

            .note {
                height: 28px;
                font-size: 10px;
                padding: 6px 8px;
            }

            .quantity {
                gap: 6px;
                padding: 4px;
            }

            .qty-btn {
                width: 24px;
                height: 24px;
                font-size: 12px;
            }

            .qty-input {
                width: 35px;
                height: 24px;
                font-size: 11px;
            }

            .delete {
                width: 26px;
                height: 26px;
                font-size: 14px;
            }

            .summary {
                padding: 15px;
            }

            .summary-row {
                font-size: 12px;
            }

            .summary-total {
                font-size: 14px;
            }

            .checkout {
                height: 44px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="header-content">
            <div class="back" onclick="goBack()">←</div>
            <div>
                <h2>Keranjang Belanja</h2>
                <p>Periksa dan kelola pesanan Anda sebelum checkout</p>
            </div>
        </div>
    </div>

    <!-- CONTENT WRAPPER -->
    <div class="content-wrapper">
        
        <!-- CONTENT ITEMS -->
        <div class="content">
            @if(count($cart ?? []) > 0)
                @foreach($cart as $item)
                    <!-- PRODUK -->
                    <div class="cart-item" data-price="{{ $item['price'] }}">

                        <img
                            src="{{ $item['image'] }}"
                            class="product-image"
                            alt="{{ $item['name'] }}"
                        >

                        <div class="product-info">
                            <h3>{{ $item['name'] }}</h3>
                            <p class="portion">Porsi: <span class="qty-text">{{ $item['quantity'] ?? 1 }}</span></p>

                            <input
                                type="text"
                                class="note"
                                placeholder="Tambah catatan pesanan (optional)"
                            >

                            <p class="total-item">
                                Rp <span class="item-total">{{ number_format($item['price'] * ($item['quantity'] ?? 1), 0, ',', '.') }}</span>
                            </p>
                        </div>

                        <div class="product-actions">
                            <button class="delete" onclick="hapusItem(this)" title="Hapus item">×</button>

                            <div class="quantity">
                                <button class="qty-btn minus" onclick="ubahQty(this, -1)" title="Kurangi">−</button>
                                <input
                                    type="text"
                                    value="{{ $item['quantity'] ?? 1 }}"
                                    class="qty-input"
                                    readonly
                                >
                                <button class="qty-btn plus" onclick="ubahQty(this, 1)" title="Tambah">+</button>
                            </div>
                        </div>

                    </div>
                @endforeach

                <!-- ADD MORE -->
                <div class="add-more" onclick="addMore()">
                    + Tambah Produk Lainnya
                </div>
            @else
                <div class="empty-cart">
                    <p>🛒 Keranjang Anda kosong</p>
                    <p style="margin-top: 10px; font-size: 14px;">Mulai berbelanja sekarang!</p>
                </div>
            @endif
        </div>

        <!-- SUMMARY SIDEBAR -->
        <div class="summary-sidebar">
            <!-- RINGKASAN -->
            <div class="summary">
                <div class="summary-title">Ringkasan Pesanan</div>

                <div class="summary-row">
                    <span>Jumlah Item</span>
                    <span id="item-count">{{ count($cart ?? []) }} items</span>
                </div>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp <span id="subtotal">{{ number_format($total ?? 0, 0, ',', '.') }}</span></span>
                </div>

                <hr>

                <div class="summary-total">
                    <span>Total Pembayaran</span>
                    <span>Rp <span id="grand-total">{{ number_format($total ?? 0, 0, ',', '.') }}</span></span>
                </div>
            </div>

            <!-- CHECKOUT -->
            <button class="checkout" onclick="checkout()">
                <span class="lock">🔒</span>
                Lanjut ke Checkout
            </button>
        </div>

    </div>

</div>


<script>

    // FORMAT RUPIAH
    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }

    // KEMBALI
    function goBack() {
        window.history.back();
    }

    // TAMBAH ITEM
    function addMore() {
        window.location.href = '/home';
    }

    // UBAH JUMLAH
    function ubahQty(button, perubahan) {

        const item = button.closest('.cart-item');

        const input = item.querySelector('.qty-input');
        const qtyText = item.querySelector('.qty-text');
        const totalItem = item.querySelector('.item-total');

        let qty = parseInt(input.value);

        qty += perubahan;

        // Minimal 1
        if (qty < 1) {
            qty = 1;
        }

        input.value = qty;
        qtyText.textContent = qty;

        // Hitung harga produk
        const harga = parseInt(item.dataset.price);

        const total = harga * qty;

        totalItem.textContent = formatRupiah(total);

        updateSummary();
    }


    // HAPUS PRODUK
    function hapusItem(button) {

        const item = button.closest('.cart-item');

        item.remove();

        updateSummary();
        
        // Cek apakah keranjang kosong
        const cartItems = document.querySelectorAll('.cart-item');
        if (cartItems.length === 0) {
            const content = document.querySelector('.content');
            content.innerHTML = '<div class="empty-cart"><p>🛒 Keranjang Anda kosong</p><p style="margin-top: 10px; font-size: 14px;">Mulai berbelanja sekarang!</p></div>';
        }
    }


    // UPDATE TOTAL
    function updateSummary() {

        const items = document.querySelectorAll('.cart-item');

        let subtotal = 0;
        let jumlahItem = 0;

        items.forEach(item => {

            const harga = parseInt(item.dataset.price);

            const qty = parseInt(
                item.querySelector('.qty-input').value
            );

            subtotal += harga * qty;

            jumlahItem += qty;
        });


        document.getElementById('item-count').textContent =
            jumlahItem + " items";

        document.getElementById('subtotal').textContent =
            formatRupiah(subtotal);

        document.getElementById('grand-total').textContent =
            formatRupiah(subtotal);
    }


    // CHECKOUT
    function checkout() {

        const items = document.querySelectorAll('.cart-item');

        if (items.length === 0) {
            alert("Keranjang masih kosong!");
            return;
        }

        alert("Pesanan berhasil dilanjutkan ke checkout!");
        // Redirect ke halaman checkout
        // window.location.href = '/checkout';
    }

</script>

</body>
</html>
