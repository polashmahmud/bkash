<x-bkash::layouts.app>
    <div class="mx-auto max-w-screen-xl flex justify-center space-y-6 py-12">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        Payment Details
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Details
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        Payment Refund Details
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Details
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Payment Id
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->paymentID }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Refund Trax ID
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundTrxID }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Trx ID
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->trxID }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Transaction Status
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundTransactionStatus }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Transaction Status
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->transactionStatus }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Refund Amount
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundAmount }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Amount
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->amount }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Refund Currency
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundCurrency }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Currency
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->currency }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Refund Charge
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundCharge }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Intent
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->intent }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Refund Completed Time
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundCompletedTime }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Payment Execute Time
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->paymentExecuteTime }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Refund Status Code
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundStatusCode }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Merchant Invoice Number
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->merchantInvoiceNumber }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        Refund Status Message
                    </td>
                    <td class="px-6 py-4">
                        {{ $bkash->refundStatusMessage }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Payer Reference
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->payerReference }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Status Code
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->statusCode }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                </tr>
                <tr>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        Status Message
                    </th>
                    <td class="px-6 py-4">
                        {{ $bkash->statusMessage }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">

                    </td>
                    <td class="px-6 py-4">

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-bkash::layouts.app>
