<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Login
        </h2>
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>
                <input type="text"
                    name="name"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input type="password"
                    name="password"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>
            <button type="submit"
                    class="w-full bg-blue-700 text-white py-2 rounded-lg hover:bg-blue-800 transition">
                Login
            </button>
        </form>
    </div>
</body>
</html>
