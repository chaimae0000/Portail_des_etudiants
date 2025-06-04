<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VIE EMSI - Register</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="VIE EMSI Register" name="keywords">
    <meta content="VIE EMSI Student Registration" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fffe 0%, #e8f5e8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .wrapper {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            display: flex;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 600px;
        }

        .col-left {
            flex: 1;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 40px;
            position: relative;
        }

        .col-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="70" cy="70" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.5;
        }

        .login-text {
            text-align: center;
            color: white;
            z-index: 2;
            position: relative;
        }

        .login-text h2 {
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-text p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.95;
            font-weight: 300;
        }

        .col-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 40px;
            background: #fafafa;
        }

        .login-form {
            width: 100%;
            max-width: 350px;
        }

        .login-form h2 {
            font-size: 2rem;
            font-weight: 500;
            color: #2d3748;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            font-size: 0.95rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .form-group input:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .btn {
            width: 100%;
            padding: 14px 16px;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: rgb(0, 0, 0);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .btn:hover {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* Back to Login button styling */
        .col-left .btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.5);
            width: auto;
            padding: 12px 30px;
            font-weight: 400;
            backdrop-filter: blur(10px);
            text-decoration: none;
            display: inline-block;
        }

        .col-left .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.7);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        .alert {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .alert li {
            color: #dc2626;
            font-size: 0.9rem;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                margin: 10px;
            }

            .col-left, .col-right {
                padding: 40px 30px;
            }

            .login-text h2 {
                font-size: 2.5rem;
            }

            .login-form h2 {
                font-size: 1.8rem;
            }

            .col-left {
                min-height: 250px;
            }
        }

        @media (max-width: 480px) {
            .wrapper {
                padding: 10px;
            }

            .col-left, .col-right {
                padding: 30px 20px;
            }

            .login-text h2 {
                font-size: 2rem;
            }

            .login-form h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper login-3">
        <div class="container">
            <div class="col-left">
                <div class="login-text">
                    <h2>VIE EMSI</h2>
                    <p>
                        Rejoins notre communauté VIE EMSI et découvre tous les événements, publications, actualités et contenus exclusifs liés à notre école. Un espace dédié aux échanges, à l’engagement et à la vie étudiante !


                    </p>
                    <a class="btn" href="{{ route('login') }}">Back to Login</a>
                </div>
            </div>
            <div class="col-right">
                <div class="login-form">
                    <h2>Register</h2>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
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