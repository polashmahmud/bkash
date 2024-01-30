<x-bkash::layouts.app>
    <div class="mx-auto max-w-2xl flex justify-center space-y-6 py-12">

        <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Payment Refund</h5>
                <a href="/bkash" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                    Back to list
                </a>
            </div>
            <div class="flow-root">
                <form action="{{ route('bkash.payment.refund') }}" method="post">
                    @csrf
                    <div>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PaymentID</label>
                        <input value="{{ $bkash->paymentID }}" name="paymentID" type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mt-4">
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TrxID</label>
                        <input value="{{ $bkash->trxID }}" name="trxID" type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mt-4">
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input value="{{ $bkash->amount }}" name="amount" type="number" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mt-4">
                        <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reason</label>
                        <input type="text" value="Quality issue" name="reason" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Refund</button>
                    </div>
                </form>

                <br><br>
                <div class="text-center text-gray-200">
                    @if(isset($response))
                        {{ $response }}
                    @endif
                </div>
            </div>
        </div>

    </div>
</x-bkash::layouts.app>
