<!DOCTYPE html>
<html>
<head>
    <title>Markas Sirkel - Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
        }
        .auth-card {
            border-radius: 15px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="col-md-4">
        <div class="card shadow-lg p-4 auth-card">
            @yield('content')
        </div>
    </div>

</body>
</html>