<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal banking</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-family: 'Inter', sans-serif;
        }

        .logo-container {
            position: fixed;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            z-index: 1000;
            /* Đảm bảo logo luôn hiển thị phía trên */
        }

        .logo-container img {
            width: 60px;
            height: 60px;
        }

        .logo-container span {
            font-size: 1.2rem;
        }

        .language-button {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }

        .language-button button {
            background-color: #6c63ff;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            max-width: 800px;
            margin: 100px auto;
            text-align: center;
        }

        .carousel-container {
            margin-top: 20px;
            position: relative;
        }

        .carousel-inner {
            position: relative;
            min-height: 380px;
        }

        .carousel-item {
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            height: 100%;
        }

        .carousel-item img {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .list-group-item {
            font-size: 1.2rem;
            font-weight: 500;
            border: 1px solid #6c63ff !important;
            border-radius: 10px !important;
            padding: 10px;
            margin-bottom: 50px;
        }

        .list-group-item i {
            font-size: 1.5rem;
            color: #6c63ff;
        }

        .carousel-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-top: 20px;
        }

        .carousel-indicators {
            position: absolute;
            bottom: -50px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #6c63ff;
            /* Màu chấm */
        }

        .carousel-indicators .active {
            background-color: #4a4ae6;
            /* Màu chấm được chọn */
        }

        .btn-wrapper a {
            transition: 0.1s all linear;
            width: 225px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            padding: 12px;
            border-radius: 16px;
        }

        .btn-wrapper .btn-register {
            background-color: #6c63ff;
            color: #fff;
        }

        .btn-wrapper .btn-register:hover {
            background-color: #4a4ae6;
        }

        .btn-wrapper .btn-login {
            background-color: #eee;
            color: #6c63ff;
        }

        .btn-wrapper .btn-login:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <!-- Logo -->
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h5>Money Mate</h5>
    </div>

    <!-- Language Button -->
    <div class="language-button">
        <button>TIẾNG VIỆT</button>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Slideshow -->
        <div class="carousel-container">
            <div id="slideshow" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1500">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div>
                            <div class="list-group-item">
                                <i class="me-2 fas fa-cut"></i> Giảm các khoản chi không cần thiết
                            </div>
                            <div class="list-group-item">
                                <i class="me-2 fas fa-piggy-bank"></i> Tiết kiệm đều đặn hàng tháng
                            </div>
                            <div class="list-group-item">
                                <i class="me-2 fas fa-chart-line"></i> Quản lý tất cả ở một nơi
                            </div>
                            <h3 class="carousel-title">Quản lý tài chính hiệu quả với Money Mate</h3>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div>
                            <img src="{{ asset('images/homeImg1.png') }}" alt="Sinh viên tin tưởng" class="img-fluid">
                            <h3 class="carousel-title">Hàng nghìn sinh viên tin tưởng và yêu mến</h3>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div>
                            <img src="{{ asset('images/homeImg2.png') }}" alt="Hành trình tài chính" class="img-fluid">
                            <h3 class="carousel-title">Bắt đầu hành trình quản lý tài chính của bạn</h3>
                        </div>
                    </div>
                </div>
                <!-- Nút điều khiển -->
                <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <!-- Buttons -->
    <div class="btn-wrapper d-flex flex-column align-items-center justify-content-center gap-3">
        <a href="{{ route('register') }}" class="btn-register">ĐĂNG KÝ</a>
        <a href="{{ route('login') }}" class="btn-login">ĐĂNG NHẬP</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
