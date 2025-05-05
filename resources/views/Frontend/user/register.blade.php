<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vie EMSI - Register</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Register Form Template" name="keywords">
    <meta content="Register Form Template" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Stylesheet -->
    <link href="{{ asset('assets/css/loginstyle.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper login-3">
        <div class="container">
            <div class="col-left">
                <div class="login-text">
                    <h2>Vie EMSI</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada vel libero vitae eleifend. Fusce tristique ipsum lorem.
                    </p>
                    <a class="btn" href="{{ route('login') }}">Back to Login</a>
                </div>
            </div>
            <div class="col-right">
                <div class="login-form">
                    <h2>Register</h2>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="color:red">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('storeRegister') }}">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" placeholder="Username" required>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>

                        <input type="hidden" name="role" value="membre">

                        <div class="form-group">
                            <input class="btn" type="submit" value="Register">
                        </div>
                    </form>



                </div>
            </div>
        </div>
        
    </div>
</body>

</html>