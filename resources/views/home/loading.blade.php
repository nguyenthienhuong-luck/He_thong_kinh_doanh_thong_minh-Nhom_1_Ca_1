<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>SmartBudget - Loading</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Inter', sans-serif;
        background: url("{{ asset('images/bgloading.png') }}") no-repeat center center/cover;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden;
        position: relative;
    }

    /* 🌑 Lớp phủ mờ giúp chữ nổi bật */
    body::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45); /* độ mờ tối nhẹ */
        z-index: 0;
    }

    .loading-container {
        text-align: center;
        z-index: 1;
        color: #fff; /* chữ trắng nổi bật */
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.4); /* đổ bóng mềm để dễ đọc */
    }

    .loading-container h1 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .loading-container p {
        font-size: 1.2rem;
        font-style: italic;
        color: #f2f2f2;
        margin-top: 5px;
    }

    .loading-footer {
        position: absolute;
        bottom: 25px;
        text-align: center;
        width: 100%;
        font-size: 1rem;
        color: #eaeaea;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
</style>
</head>

<body>
    <div class="loading-container">
        <h1>SmartBudget</h1>
    </div>
    <div class="loading-footer">
        Nhóm 1 Cụm 1 64HTTT2 - ThuyLoi University
    </div>

    <script>
        // Chờ 2 giây và chuyển hướng đến trang chủ
        setTimeout(() => {
            window.location.href = "{{ route('home') }}";
        }, 5000);
    </script>
</body>

</html>
