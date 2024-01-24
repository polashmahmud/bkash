<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Include Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-500 h-screen flex items-center justify-center">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-gray-800">
    <!-- Congratulations without animation -->
    <h1 class="text-3xl font-bold mb-4 text-center text-gray-900">
        Congratulations!
    </h1>

    <!-- Display payment details in a table -->
    <table class="w-full mb-6">
        <tbody>
        @foreach($response as $key => $value)
            @if($key == 'amount')
                <tr>
                    <td class="py-2"><strong>Amount in BDT:</strong></td>
                    <td class="py-2">{{ $value }}</td>
                </tr>
            @endif
            @if($key == 'transactionStatus')
                <tr>
                    <td class="py-2"><strong>Transaction Status:</strong></td>
                    <td class="py-2">{{ $value }}</td>
                </tr>
            @endif
            @if($key == 'trxID')
                <tr>
                    <td class="py-2"><strong>Transaction ID:</strong></td>
                    <td class="py-2">{{ $value }}</td>
                </tr>
            @endif
            @if($key == 'merchantInvoiceNumber')
                <tr>
                    <td class="py-2"><strong>Invoice Number:</strong></td>
                    <td class="py-2">{{ $value }}</td>
                </tr>
            @endif
            @if($key == 'paymentID')
                <tr>
                    <td class="py-2"><strong>Payment ID:</strong></td>
                    <td class="py-2">{{ $value }}</td>
                </tr>
            @endif
        @endforeach
        <!-- Add more rows for other payment details -->
        </tbody>
    </table>

    <!-- Back button -->
    <div class="flex justify-center">
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 transform hover:scale-105">Back to Home</a>
    </div>
</div>
</body>
</html>
