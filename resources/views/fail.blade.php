<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failure</title>
    <!-- Include Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-red-500 to-pink-500 h-screen flex items-center justify-center">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-gray-800">
    <!-- Payment failure message without animation -->
    <h1 class="text-3xl font-bold mb-4 text-center text-gray-900">
        Payment Failed!
    </h1>

    <!-- Display payment details in a table -->
    @if(isset($response))
        <p class="text-red-500 font-bold text-center">
            {{ $response }}
        </p>
    @endif

    @if($redirect)
        <div class="flex justify-center mt-6">
            <a href="/{{ $redirect }}"
               class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 transform hover:scale-105">Back</a>
        </div>
    @endif
</div>
</body>
</html>
