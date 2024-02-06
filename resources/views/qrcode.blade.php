<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        img {
            width: 400px;
            height: 400px;
        }
    </style>
</head>
<body>
    <img src="{{ $imagePath }}" alt="Product QR Code">
</body>
</html>
