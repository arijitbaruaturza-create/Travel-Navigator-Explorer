<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

<div class="bg-white p-8 rounded-xl shadow w-96">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    @if(session('error'))
        <p class="text-red-500 mb-3">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-3 p-2 border rounded" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-4 p-2 border rounded" required>

        <button class="w-full bg-blue-600 text-white py-2 rounded">
            Login
        </button>
    </form>

    <p class="mt-4 text-center">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-600">Sign Up</a>
    </p>
</div>

</body>
</html>