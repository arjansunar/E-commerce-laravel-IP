<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Tailwind</title>
    <script defer src="https://unpkg.com/alpinejs@3.2.2/dist/cdn.min.js"></script>

</head>
<body>
<h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>
</body>
</html>