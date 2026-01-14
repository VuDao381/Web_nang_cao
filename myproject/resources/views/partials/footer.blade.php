<footer class="footer">
    <div class="footer-container">

        <!-- About -->
        <div class="footer-box">
            <h3>📚 ABC Book</h3>
            <p>
                ABC Book là cửa hàng sách trực tuyến cung cấp đa dạng
                các đầu sách chất lượng, giá tốt và dịch vụ uy tín.
            </p>
        </div>

        <!-- Quick links -->
        <div class="footer-box">
            <h4>Liên kết nhanh</h4>
            <ul>
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li><a href="{{ route('books.index') }}">Sách</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div class="footer-box">
            <h4>Liên hệ</h4>
            <p>📍 123 Đường ABC, Hà Nội</p>
            <p>📞 0987 654 321</p>
            <p>✉ abcbook@gmail.com</p>
        </div>

    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        © {{ date('Y') }} ABC Book. All rights reserved.
    </div>
</footer>
