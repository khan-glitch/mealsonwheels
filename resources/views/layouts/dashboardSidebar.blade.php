<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <div class="w-48 md:w-64 bg-gray-800 text-white flex-shrink-0">
        <div class="p-6">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="/" class="inline-flex items-center text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="text-lg font-medium">Back</span>
                </a>
            </div>

            <h1 class="text-2xl font-bold mb-5 text-center md:text-left">Admin Dashboard</h1>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Home</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Analytics</a>
                <a href="{{route('admin.volunteers')}}" class="block py-2 px-4 rounded hover:bg-gray-700">Volunteers</a>
                <a href="{{ route('admin.donations') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Donations</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Reports</a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow p-6 space-y-6">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
