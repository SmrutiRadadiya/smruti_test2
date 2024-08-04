<?php
    $email = Session::get('email');
    if($email != ''){ ?>
<script>
window.location = "/blogs";
</script>
<?php }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app_assets/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Add Poppins Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Add Styling -->
    <style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .form-container {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .form-group label {
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-primary {
        width: 100%;
    }
    </style>
</head>

<body>
    <!-- Login Form -->
    <form action="/login_user" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>