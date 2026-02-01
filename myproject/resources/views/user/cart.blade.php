@extends('layouts.myapp')

@section('title', 'Giỏ hàng của bạn')

@section('styles')
<style>
    .cart-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .cart-title {
        font-size: 24px;
        color: #2b6d2c;
        margin-bottom: 25px;
        font-weight: 700;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-table th, .cart-table td {
        padding: 15px 20px;
        text-align: left;
    }

    .cart-table th {
        background-color: #2b6d2c;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
    }

    .cart-table td {
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .cart-item-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart-item-img {
        width: 60px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .cart-item-title {
        font-weight: 600;
        color: #333;
        font-size: 15px;
    }

    .qty-input {
        width: 60px;
        padding: 5px 10px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn-update {
        background: none;
        border: none;
        color: #3498db;
        cursor: pointer;
        margin-left: 5px;
    }

    .btn-remove {
        color: #e74c3c;
        text-decoration: none;
        font-size: 18px;
        transition: 0.2s;
    }

    .btn-remove:hover {
        color: #c0392b;
    }

    .cart-summary {
        margin-top: 30px;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        display: flex;
        justify-content: flex-end;
    }

    .summary-box {
        width: 300px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .summary-row.total {
        font-weight: 700;
        font-size: 20px;
        color: #2b6d2c;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .btn-checkout {
        display: block;
        width: 100%;
        background: #2b6d2c;
        color: #fff;
        text-align: center;
        padding: 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 20px;
        transition: 0.2s;
    }

    .btn-checkout:hover {
        background: #245b26;
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 8px;
    }

    .empty-cart i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-cart p {
        font-size: 18px;
        color: #777;
        margin-bottom: 20px;
    }

    .alert {
        padding: 12px 20px;
        margin-bottom: 20px;
        border-radius: 6px;
        background: #d4edda;
        color: #155724;
    }

    /* Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 2000;
        justify-content: center;
        align-items: center;
    }

    .modal-box {
        background: white;
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        animation: fadeIn 0.2s ease-out;
    }

    .modal-icon {
        font-size: 50px;
        margin-bottom: 20px;
        color: #2b6d2c;
    }

    .modal-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .modal-text {
        color: #666;
        margin-bottom: 25px;
    }

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .btn-modal {
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        transition: 0.2s;
    }

    .btn-confirm {
        background: #2b6d2c;
        color: white;
    }
    .btn-confirm:hover { background: #245b26; }

    .btn-cancel {
        background: #eee;
        color: #333;
    }
    .btn-cancel:hover { background: #ddd; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .th-product { width: 40%; }
    .th-price { width: 15%; }
    .th-qty { width: 20%; }
    .th-total { width: 15%; }
    .th-action { width: 10%; }

    .item-category { color: #777; }
    .item-subtotal { font-weight: 600; color: #333; }
    .item-action { text-align: center; }
    
    .form-update-qty { display: flex; align-items: center; }

    .summary-note {
        margin-top: 15px; 
        font-size: 13px; 
        color: #666; 
        font-style: italic; 
        line-height: 1.4;
    }
    .summary-note i {
        color: #2b6d2c; 
        margin-right: 5px;
    }
    .continue-shopping {
        display: block; 
        text-align: center; 
        margin-top: 15px; 
        color: #555; 
        text-decoration: none;
    }
</style>
@endsection

@section('content')
    @include('partials.header')

    <div class="cart-container">
        <h1 class="cart-title">Giỏ hàng của bạn</h1>

        @if(session('success'))
            <div class="alert">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($cart && $cart->items->count() > 0)
            <table class="cart-table">
                <thead>
                    <tr>
                        <th class="th-product">Sản phẩm</th>
                        <th class="th-price">Đơn giá</th>
                        <th class="th-qty">Số lượng</th>
                        <th class="th-total">Thành tiền</th>
                        <th class="th-action"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart->items as $item)
                        @php 
                            $subtotal = $item->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="cart-item-info">
                                    <img src="{{ $item->book->image ?: 'https://via.placeholder.com/60x80' }}" alt="{{ $item->book->title }}" class="cart-item-img">
                                    <div>
                                        <div class="cart-item-title">{{ $item->book->title }}</div>
                                        <small class="item-category">{{ $item->book->category->name ?? 'N/A' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST" class="form-update-qty">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="qty-input">
                                    <button type="submit" class="btn-update" title="Cập nhật"><i class="fa-solid fa-rotate"></i></button>
                                </form>
                            </td>
                            <td class="item-subtotal">{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                            <td class="item-action">
                                <a href="javascript:void(0)" class="btn-remove" onclick="showDeleteModal('{{ route('cart.remove', $item->id) }}')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="summary-box">
                    <div class="summary-row">
                        <span>Tạm tính:</span>
                        <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                    </div>
                    <div class="summary-row total">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                    </div>
                    <form id="checkout-form" action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="button" class="btn-checkout" style="border:none; cursor:pointer;" onclick="showConfirmModal()">
                            Đặt hàng
                        </button>
                    </form>
                    
                    <p class="summary-note">
                        <i class="fa-solid fa-circle-info"></i>
                        Đơn hàng sẽ được xử lý trong vòng 24h và chúng tôi sẽ gửi thông báo cập nhật qua email của bạn.
                    </p>
                    <a href="{{ route('home') }}" class="continue-shopping">
                        <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <i class="fa-solid fa-basket-shopping"></i>
                <p>Giỏ hàng của bạn đang trống</p>
                <a href="{{ route('home') }}" class="btn-checkout" style="width: auto; display: inline-block; padding: 12px 30px;">
                    Mua sắm ngay
                </a>
            </div>
        @endif
    </div>

    @include('partials.footer')

    {{-- Confirm Modal --}}
    <div id="confirmModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon" style="color: #f7b731;">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <div class="modal-title">Xác nhận đặt hàng</div>
            <div class="modal-text">Bạn có chắc chắn muốn đặt hàng không?</div>
            <div class="modal-buttons">
                <button class="btn-modal btn-cancel" onclick="closeModal('confirmModal')">Hủy</button>
                <button class="btn-modal btn-confirm" onclick="submitOrder()">Đồng ý</button>
            </div>
        </div>
    </div>

    {{-- Warning/Error Modal --}}
    <div id="warningModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon" style="color: #e74c3c;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="modal-title">Thông báo</div>
            <div class="modal-text" id="warningText">Có lỗi xảy ra</div>
            <div class="modal-buttons">
                <button class="btn-modal btn-cancel" onclick="closeModal('warningModal')">Đóng</button>
                <button class="btn-modal btn-confirm" id="btnRedirectProfile" style="display:none;" onclick="window.location.href='{{ route('profile.edit') }}'">Cập nhật ngay</button>
            </div>
        </div>
    </div>

    {{-- Success Modal --}}
    <div id="successModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon" style="color: #2b6d2c;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="modal-title">Thành công!</div>
            <div class="modal-text">Đặt hàng thành công! Đơn hàng đang được xử lý.</div>
            <div class="modal-buttons">
                <button class="btn-modal btn-confirm" onclick="window.location.href='{{ route('home') }}'">Về trang chủ</button>
            </div>
        </div>
    </div>

    {{-- Delete Confirm Modal --}}
    <div id="deleteConfirmModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-icon" style="color: #e74c3c;">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <div class="modal-title">Xác nhận xóa</div>
            <div class="modal-text">Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?</div>
            <div class="modal-buttons">
                <button class="btn-modal btn-cancel" onclick="closeModal('deleteConfirmModal')">Hủy</button>
                <a id="btnConfirmDelete" href="#" class="btn-modal btn-confirm" style="background-color: #e74c3c; text-decoration: none; display: inline-block;">Xóa ngay</a>
            </div>
        </div>
    </div>

    <script>
        function showConfirmModal() {
            document.getElementById('confirmModal').style.display = 'flex';
        }

        let deleteUrl = '';
        function showDeleteModal(url) {
            deleteUrl = url;
            document.getElementById('btnConfirmDelete').href = url;
            document.getElementById('deleteConfirmModal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function submitOrder() {
            // Đóng modal xác nhận
            closeModal('confirmModal');

            // Gửi AJAX request
            const form = document.getElementById('checkout-form');
            const url = form.action;
            const token = form.querySelector('input[name="_token"]').value;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hiện modal thành công
                    document.getElementById('successModal').style.display = 'flex';
                } else {
                    // Cập nhật nội dung modal cảnh báo
                    document.getElementById('warningText').innerText = data.message;
                    
                    // Nếu lỗi liên quan đến thiếu thông tin (địa chỉ/sđt), hiện nút cập nhật
                    const btnRedirect = document.getElementById('btnRedirectProfile');
                    if (data.message && (data.message.includes('Địa chỉ') || data.message.includes('đầy đủ'))) {
                        btnRedirect.style.display = 'inline-block';
                    } else {
                        btnRedirect.style.display = 'none';
                    }

                    // Hiện modal cảnh báo
                    document.getElementById('warningModal').style.display = 'flex';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('warningText').innerText = 'Có lỗi xảy ra, vui lòng thử lại!';
                document.getElementById('warningModal').style.display = 'flex';
            });
        }
    </script>
@endsection
