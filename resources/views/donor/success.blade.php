<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <div class="max-w-lg mx-auto bg-white p-6 shadow-md rounded text-center">
            <h1 class="text-3xl font-bold text-green-600 mb-6">Payment Successful!</h1>
            <p class="text-gray-700 mb-4">Thank you for your generous donation.</p>
            <p class="text-gray-700 mb-6">Your contribution will make a difference.</p>
            <a href="{{ route('donor.index') }}" 
               class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600 transition">
                Back to Donor Page
            </a>
        </div>
    </div>
</body>
</html>
