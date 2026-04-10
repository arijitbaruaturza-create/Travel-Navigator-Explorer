<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f7f4ef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .auth-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            width: 350px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #c8753a;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #b06330;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
        }

        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }

        .link {
            margin-top: 10px;
            text-align: center;
        }

        .link a {
            color: #c8753a;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <h2>Admin Register</h2>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="message error">
            <ul style="margin:0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/admin/register">
        @csrf
        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>

    <div class="link">
        Already have an account? <a href="/admin/login">Login here</a>
    </div>
</div>

</body>
</html>