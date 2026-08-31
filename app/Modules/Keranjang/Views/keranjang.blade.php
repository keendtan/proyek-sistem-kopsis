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

        .wrapper {
            display: flex;
            min-height: 100vh;
            gap: 20px;
            padding: 20px;
        }

        .container {
            flex: 1;
            background: #fffafa;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* HEADER */
        .header {
            background: #ae282d;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .back {
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .back:hover {
            transform: scale(1.1);
        }

        .header-text h2 {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .header-text p {
            font-size: 12px;
            opacity: 0.9;
        }

        /* CONTENT */
        .content {
            padding: 20px;
            flex: 1;
            overflow-y: auto;
        }

        /* CART ITEMS LIST */
        .cart-items-wrapper {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        /* CARD PRODUK */
        .cart-item {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: grid;
            grid-template-columns: 80px 1fr 50px;
            gap: 12px;
            align-items: start;
            position: relative;
            border: 1px solid #f0f0f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .cart-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            transform: translateY(-2px);
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .product-info h3 {
            color: #a51e27;
            font-size: 14px;
            font-weight: 600;
            margin: 0;
        }

        .portion {
            color: #666;
            font-size: 12px;
        }

        .note {
            width: 100%;
            border: 1px dashed #ef8d8d;
            border-radius: 6px;
            padding: 6px 8px;
            font-size: 11px;
            color: #999;
            font-family: inherit;
        }

        .note::placeholder {
            color: #bbb;
        }

        .price-section {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .total-item {
            color: #a51e27;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* QUANTITY CONTROL */
        .quantity {
            display: flex;
            align-items: center;
            gap: 4px;
            background: #f9f9f9;
            border-radius: 6px;
            padding: 4px;
        }

        .qty-btn {
            width: 24px;
            height: 24px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s;
        }

        .minus {
            background: #bbb;
            color: white;
        }

        .minus:hover {
            background: #999;
        }

        .plus {
            background: #a00028;
            color: white;
        }

        .plus:hover {
            background: #8a0220;
        }

        .qty-input {
            width: 32px;
            height: 24px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            font-size: 12px;
            background: white;
        }

        /* DELETE BUTTON */
        .delete {
            position: absolute;
            right: 12px;
            top: 12px;
            border: none;
            background: none;
            color: #d32f2f;
            font-size: 20px;
            cursor: pointer;
            padding: 4px 8px;
            transition: color 0.2s;
        }

        .delete:hover {
            color: #b71c1c;
        }

        /* ADD MORE */
        .add-more {
            color: #a00028;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            padding: 10px;
            text-align: center;
            background: #fff9f9;
            border: 1px dashed #ef8d8d;
            border-radius: 8px;
            transition: all 0.2s;
            margin-bottom: 15px;
        }

        .add-more:hover {
            background: #ffe8e8;
            border-color: #a00028;
        }

        /* SUMMARY */
        .summary {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-top: 3px solid #ae282d;
            margin-top: auto;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #333;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .summary-row span:last-child {
            color: #a00028;
            font-weight: 500;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            color: #a00028;
            font-size: 16px;
            font-weight: 700;
            padding-top: 10px;
        }

        /* CHECKOUT */
        .checkout {
            width: 100%;
            padding: 14px;
            margin-top: 15px;
            background: #980b2b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .checkout:hover {
            background: #7d0924;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(152, 11, 43, 0.3);
        }

        .checkout:active {
            transform: translateY(0);
        }

        .lock {
            margin-right: 8px;
        }

        /* EMPTY STATE */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            text-align: center;
            color: #999;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #666;
        }

        .empty-state p {
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 767px) {
            .wrapper {
                flex-direction: column;
                padding: 0;
                gap: 0;
            }

            .container {
                border-radius: 0;
                box-shadow: none;
                min-height: 100vh;
            }

            .header {
                padding: 16px 12px;
                border-radius: 0 0 12px 12px;
            }

            .header-text h2 {
                font-size: 18px;
            }

            .content {
                padding: 12px;
            }

            .cart-item {
                grid-template-columns: 70px 1fr 40px;
                gap: 10px;
                padding: 12px;
            }

            .product-image {
                width: 70px;
                height: 70px;
            }

            .product-info h3 {
                font-size: 13px;
            }

            .note {
                font-size: 10px;
                padding: 4px 6px;
            }

            .total-item {
                font-size: 12px;
            }

            .delete {
                right: 8px;
                top: 8px;
                font-size: 18px;
            }

            .add-more {
                font-size: 12px;
                padding: 8px;
            }

            .summary {
                padding: 12px;
            }

            .summary-row {
                font-size: 12px;
                margin-bottom: 8px;
                padding-bottom: 8px;
            }

            .summary-total {
                font-size: 15px;
            }

            .checkout {
                padding: 12px;
                font-size: 13px;
                margin-top: 12px;
            }
        }

        /* DESKTOP RESPONSIVE */
        @media (min-width: 768px) {
            .wrapper {
                max-width: 1200px;
                margin: 0 auto;
            }

            .container {
                max-width: 900px;
                margin: 0 auto;
            }

            .content {
                max-height: calc(100vh - 120px);
            }

            .cart-items-wrapper {
                gap: 12px;
            }

            .cart-item {
                grid-template-columns: 100px 1fr 80px;
            }

            .product-image {
                width: 100px;
                height: 100px;
            }

            .product-info h3 {
                font-size: 15px;
            }

            .note {
                font-size: 12px;
            }

            .summary {
                min-height: 150px;
            }
        }

        /* SCROLLBAR STYLING */
        .content::-webkit-scrollbar {
            width: 6px;
        }

        .content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .content::-webkit-scrollbar-thumb {
            background: #ae282d;
            border-radius: 3px;
        }

        .content::-webkit-scrollbar-thumb:hover {
            background: #8a1f24;
        }
    </style>
</head>

<body>

<div class="wrapper">
    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <div class="back" onclick="goBack()">↪</div>
            <div class="header-text">
                <h2>Keranjang</h2>
                <p>Periksa pesanan anda sebelum checkout</p>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- CART ITEMS -->
            <div class="cart-items-wrapper" id="cartItems">
                <div class="empty-state">
                    <div class="empty-state-icon">🛒</div>
                    <h3>Keranjang Kosong</h3>
                    <p>Tambahkan produk untuk melanjutkan</p>
                </div>
            </div>

            <!-- ADD MORE -->
            <div class="add-more" onclick="addMore()">
                + Tambah Pesanan Lagi
            </div>

            <!-- RINGKASAN -->
            <div class="summary">
                <div class="summary-row">
                    <span>Jumlah Item</span>
                    <span id="item-count">0 items</span>
                </div>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp <span id="subtotal">0</span></span>
                </div>

                <div class="summary-total">
                    <span>Total Bayar</span>
                    <span>Rp <span id="grand-total">0</span></span>
                </div>

                <!-- CHECKOUT -->
                <button class="checkout" onclick="checkout()">
                    <span class="lock">🛍️</span>
                    Lanjut Checkout
                </button>
            </div>

        </div>

    </div>
</div>

<script>

    // FORMAT RUPIAH
    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
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
        if (qty < 1) qty = 1;

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
        checkEmptyCart();
    }

    // UPDATE TOTAL
    function updateSummary() {
        const items = document.querySelectorAll('.cart-item');
        let subtotal = 0;
        let jumlahItem = 0;

        items.forEach(item => {
            const harga = parseInt(item.dataset.price);
            const qty = parseInt(item.querySelector('.qty-input').value);
            subtotal += harga * qty;
            jumlahItem += qty;
        });

        document.getElementById('item-count').textContent = jumlahItem + " items";
        document.getElementById('subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('grand-total').textContent = formatRupiah(subtotal);
    }

    // CEK KERANJANG KOSONG
    function checkEmptyCart() {
        const items = document.querySelectorAll('.cart-item');
        const cartItems = document.getElementById('cartItems');
        
        if (items.length === 0) {
            cartItems.innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">🛒</div>
                    <h3>Keranjang Kosong</h3>
                    <p>Tambahkan produk untuk melanjutkan</p>
                </div>
            `;
        }
    }

    // ADD MORE
    function addMore() {
        window.location.href = "{{ route('frontend.index') }}";
    }

    // GO BACK
    function goBack() {
        window.history.back();
    }

    // CHECKOUT
    function checkout() {
        const items = document.querySelectorAll('.cart-item');
        if (items.length === 0) {
            alert("Keranjang masih kosong!");
            return;
        }
        alert("Pesanan berhasil dilanjutkan ke checkout!");
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        checkEmptyCart();
        updateSummary();
    });

</script>

</body>
</html>
