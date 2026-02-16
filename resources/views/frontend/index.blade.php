<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | Alumni Connect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('frontend_assets/images/logo-black.png') }}"
                     alt="Alumni Connect" height="40">
            </a>

            <div class="ms-auto">
                <a href="{{ route('university.login') }}" class="btn btn-outline-primary">
                    University Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Center Coming Soon Image -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <img src="{{ asset('frontend_assets/images/coming-soon-black.png') }}"
             alt="Coming Soon"
             class="img-fluid"
             style="max-width: 350px;">
    </div>

</body>
</html>
