<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Date
            </th>
            <th scope="col" class="px-6 py-3">
                Mobile
            </th>
            <th scope="col" class="px-6 py-3">
                Payment ID
            </th>
            <th scope="col" class="px-6 py-3">
                Tax ID
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
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
                    {{ $transaction->created_at->format('d M Y') }}
                </th>
                <td class="px-6 py-4">
                    {{ $transaction->customerMsisdn }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->paymentID }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->trxID }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->transactionStatus }}
                </td>
                <td class="px-6 py-4">
                    ৳ {{ $transaction->amount }}
                </td>
                <td class="px-6 py-4 space-x-3">
                    <a href="{{ route('bkash.show', $transaction->id) }}"
                       class="text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:underline dark:hover:text-blue-400">
                        View
                    </a>
                    <a href="/bkash/refund/{{ $transaction->id }}"
                       class="text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:underline dark:hover:text-blue-400">
                        Refund
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div>
    {{ $transactions->links() }}
</div>
