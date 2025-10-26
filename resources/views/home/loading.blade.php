<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Money Mate - Loading</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #b7d5dbff;
            color: #0b0a0aff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .loading-container {
            text-align: center;
        }

        .loading-container img {
            width: 300px;
            height: 300px;
            margin-bottom: 20px;
            filter: invert(1);
        }

        .loading-container h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .loading-container p {
            font-size: 1rem;
            margin-top: 10px;
            font-style: italic;
        }

        .loading-footer {
            position: absolute;
            bottom: 20px;
            text-align: center;
            width: 100%;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="loading-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>Money Mate</h1>
        <p>Phù hợp với lứa tuổi sinh viên</p>
    </div>
    <div class="loading-footer">
        Nhóm 1 Cụm 1
    </div>

    <script>
        // Chờ 2 giây và chuyển hướng đến trang chủ
        setTimeout(() => {
            window.location.href = "{{ route('home') }}";
        }, 3000);
    </script>
</body>

</html>
