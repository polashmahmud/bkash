<div class="flex items-center space-x-6">
    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                Total Amount: ৳ {{ $total }}
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
            Total amount of {{ $period }} days
        </p>
    </div>
    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                Total Transactions: {{ $totalTransactions }}
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
            Total transactions of {{ $period }} days
        </p>
    </div>
    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                Total Refunds: 100
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
            Total refunds of {{ $period }} days
        </p>
    </div>
</div>
