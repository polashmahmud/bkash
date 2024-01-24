<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="dark bg-gray-900">
    <div class="mx-auto max-w-4xl py-12 space-y-6">
        <div class="flex items-center justify-between space-x-3">
            <div class="border border-gray-700 w-full rounded-lg p-4 font-bold text-2xl text-gray-300 bg-gray-800">
                Total: 2000 BDT
            </div>
            <div class="border border-gray-700 w-full rounded-lg p-4 font-bold text-2xl text-gray-300 bg-gray-800">
                Refunded: 1000 BDT
            </div>
        </div>

        <form>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search ..." required>
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Payment ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Trx ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mobile
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $transaction->paymentID }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $transaction->trxID }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaction->transactionStatus }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaction->amount }} BDT
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaction->customerMsisdn }}
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="" class="text-red-600 hover:text-red-900">Refund</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $transactions->links() }}
        </div>
    </div>
</body>
</html>
