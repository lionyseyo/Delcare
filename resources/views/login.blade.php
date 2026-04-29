<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-image">
                <img src="img/background_login.jpg" alt="Background Image">
            </div>
            <div class="login-form">
                <h2>Selamat Datang!</h2>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
